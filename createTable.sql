create table employee
(
    empId       bigint primary key not null,
    fName       varchar(25) not null,
    lName       varchar(25) not null,
    superId     bigint default '0',
    userName    varchar(20) not null,
    password    varchar(32) not null
);


create table leaves
(
    ID          INT primary key auto_increment not null,
    empId       bigint references employee (empID),
    startDate   date not null,
    endDate     date not null,
    status      char(8) not null default "Pending",
    type        varchar(6) not null default "Unpaid",
    reason      varchar(200)
    check ((status = "Approved" or status = "Pending" or status = "Rejected") 
    and (datediff(endDate, startDate) >= 0) and (type = "Pain" or type = "Unpaid"))
);


create table lcount
(
    empId       bigint primary key references employee (empID),
    total       int not null,
    remaining   int not null
);


create trigger update_lcount_on_insert after insert on leaves for each row 
  update lcount 
    set remaining = remaining - datediff(new.endDate, new.startDate) - 1
  where lcount.empId=new.empId;


create trigger update_lcount_on_update after update on leaves for each row
  update lcount
    set remaining  = if (new.status = 'Rejected',
      remaining + datediff(old.endDate, old.startDate) + 1,
      if ((new.status = 'Approved' or new.status='Pending')
        and old.status='Rejected',
          remaining - datediff(old.endDate, old.startDate) - 1, remaining))
  where lcount.empId=old.empId;

