update doctorinformation
set officeName=:officeName, officeType=:officeType, officeAddress=:officeAddress, officeZip=:officeZip, officeCity=:officeCity, officePhone=:officePhone, patients=:patients
where doctorId=:doctorId;
