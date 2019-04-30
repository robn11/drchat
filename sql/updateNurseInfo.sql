update nurseinformation
set schoolName=:schoolName, schoolType=:schoolType, schoolAddress=:schoolAddress, schoolCity=:schoolCity, schoolZip=:schoolZip, schoolPhone=:schoolPhone, students=:students
where nurseid=:nurseid;
