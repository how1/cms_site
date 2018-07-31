# Setup

Use a LAMP server or xampp

On a LAMP server:
1. Place root directory in, or clone git repo to /var/www/html
2. Set up database tables in mySql
3. In mysql turn off strict mode using: SET sql_mode = '';

With xampp:
1. Place root directory in, or clone git repo to /xampp/htdocs/
2. Set up database tables in http://localhost/phpmyadmin

Database tables: blank field value type == varchar

name: categories

columns:	
			
			cat_id			    	primary key, ai
			
			cat_title
			
name: comments

columns: 	
			
			comment_id			primary key, ai

			comment_post_id		int
			
			comment_author
			
			comment_email
			
			comment_content		text
			
			comment_status
			
			comment_date		date
			
name: posts	

columns:	
			
			post_id				primary key, ai

			post_category_id	int

			post_title
			
			post_author
			
			post_date			date
			
			post_image			text
			
			post_content		text
			
			post_tags
			
			post_comment_count	int
			
			post_status			
			

name: users

columns:	
			
			user_id				primary key, ai

			username
			
			user_password
			
			user_firstname
			
			user_lastname
			
			user_email
			
			user_image			text
			
			user_role
			
			randSalt