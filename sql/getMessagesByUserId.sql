select * from messages m join customers c on m.fromid=c.customerid where toid=:userId;