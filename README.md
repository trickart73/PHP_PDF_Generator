# PHP_PDF_Generator
A small PHP server who runs some PDF Generator.

The project was a real help for some friend doctor.
The personnal informations were deleted and replaced by John Doe.

# How to install

1) Install some server on your PC (like Wamp)  
https://www.youtube.com/watch?v=EcbLIJloI28

2) Intall Composer & MPdf  
https://www.youtube.com/watch?v=MnIps8Yc8CY

3) Copy the files into the concerned repository
(Ex : for wamp, I copied the files into ...\wamp64\www\amitweb)

4) For the mail sender, you have to explore the file to modify :
- "$mail->Host       = 'smtp.gmail.com';"
- "$mail->Username   = 'your-email@gmail.com';"
- "$mail->Password   = 'XXXXXX';"
