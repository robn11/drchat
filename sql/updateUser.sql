update customers
set name=:name, email=:email, phone=:phone, address=:address, city=:city, zip=:zip, isDR=:isDR
where username = :username;