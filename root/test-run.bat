setlocal DISABLEDELAYEDEXPANSION
set PATH=%PATH%;%~dp0..\php
%~dp0vendor\bin\phpunit tests
pause