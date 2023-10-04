$ExternalDir= ".\glpi_ExternalDirs_ver_9"
$Maindir = ".\glpi10.0.9"


# everyone 
icacls $Maindir --% /grant *S-1-1-00:(OI)(CI)RX /T /C

#authenticated users 

icacls $Maindir --% /grant *S-1-5-11:(OI)(CI)RX /T /C

#nPAPPSRV01$ User
icacls $Maindir --% /grant NPWSD-6NVC5N3$:(OI)(CI)F /T /C

icacls $Maindir --% /grant IIS_IUSRS:(OI)(CI)F /T /C

#authenticated users 
icacls $Maindir --% /grant *S-1-5-11:(OI)(CI)M /T /C

#Εξωτερικός κατάλογος 
# everyone 
icacls $ExternalDir --% /grant *S-1-1-00:(OI)(CI)RX /T /C

#authenticated users 
icacls $ExternalDir --% /grant *S-1-5-11:(OI)(CI)M /T /C

#nPAPPSRV01$ User
icacls $ExternalDir --% /grant NPWSD-6NVC5N3$:(OI)(CI)F /T /C

icacls $ExternalDir --% /grant IIS_IUSRS:(OI)(CI)F /T /C