/* Select customers where the username and password match those passed as parameters */
select * from customers where username=:username and password=:password;