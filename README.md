WopiHost
========

Microsoft Office Web Apps Server preview MS files

## install pux
`` $ composer install ``

## create .htaccess file like this
```
  RewriteEngine On

  RewriteBase /WopiHost/

  RewriteCond %{REQUEST_FILENAME} !-f  
  RewriteCond %{REQUEST_FILENAME} !-d 

  RewriteRule .* index.php/$0 [PT,L] 
```

## test wopi is correct
`` http://localhost/WopiHost/files/test.docx `` 

if response a json data, it's ok.



