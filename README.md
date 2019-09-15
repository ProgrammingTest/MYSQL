# MYSQL
1. Index All Columns Used in 'where', 'order by', and 'group by' Clauses and on clauses in join table

2. Use MySQL full-text search (FTS) because it is far much faster than queries using wildcard characters.

   FTS can also bring better and relevant results when you are searching a huge database.

   we must use full-text search index to all the tables used in where clause, below is the MySQL example command:

   mysql>Alter table jobs ADD FULLTEXT (name);

   mysql>Alter table JobCategories ADD FULLTEXT (name);

   And so on....

3. In where clause public_status looks ambitious without mentioning tablename, it should be tablename.public_status
