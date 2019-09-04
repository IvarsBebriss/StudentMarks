pamēģini no sākuma caur wamp servera virtual hosts management - izskatās ka viņš pats visu izdara, tikai pēc tam jārestartē serveris

C:\Windows\system32\drivers\etc\hosts
jābūt rindām:
127.0.0.1	localhost
127.0.0.1	eksamens.go


C:\wamp64\bin\apache\apache2.4.39\conf\extra
jāpievieno
<VirtualHost *:80>
	ServerName eksamens.go
	DocumentRoot "c:/wamp64/www/eksis"
</VirtualHost>