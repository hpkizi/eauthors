# eauthors

Note (missing integer primary key)
Fix original unnuke_authors table:

ALTER TABLE `unnuke_authors` DROP PRIMARY KEY;
ALTER TABLE `unnuke_authors` ADD `uid` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`uid`);

New fields:
`admincreated`  
`user_id` 


TODO:
unique user_id
test with efiction authors
