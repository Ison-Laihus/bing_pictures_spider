# bing pictures spider

The pictures in Bing are so beautiful that I can't stop myself to get them. So I write this program with PHP to fetch them.

#### technologies

- composer : to manage packages which I used in this program
- simple_html_parser : this package can make PHPer to manipulate HTML DOM as simple as a object
- file_get_contents($url) : a built-in function in PHP which can get the content from a file or a url

> be careful, I have used function `file_get_html` to get the binary data according a picture's url. I can't say it is successful or failed, the pictures which I download by using `file_get_html` is blurry, I can't even distinguish what in these pictures. So don't use `file_get_html` to get content which is not a html context.  

- curl : the client URL tool for PHP to imitate a true client to manipulate url for request and response
 
In this program, I have tried two ways to download binary data of a picture, you can choose any one by your preference. 

#### time problem
I don't know if it's the PHP Language or My Program, this program is running over **ten minutes**.   
It's so slow, I can't stand it without expectation.  
So if you extremely want these beautiful pictures, I hope you can be patient. 

#### postscript
This program is so simple. But there is a bug in my programming: I can't access the simple_html_parser package by required 'vendor/autoload.php' when I run my program although I can skip to simple_html_parser file by click function in my IDEA PHPStorm.  
It is so strange.  
I hope you cant tell me the reason if you know the reason.  