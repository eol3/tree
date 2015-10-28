# Tree
Using Codeigniter easy to implementing tree data struct,the programe can add and delete node in tree.<br>
When deleted the node , it will delete sub tree of node.<br>
Using "Depth-first Search" to search every node<br>

#樹
在Codeigniter的架構下簡單的實做樹的資料結構，這程式可以在這棵樹增加刪除節點<br>
當刪除節點，會連結點以下的子樹都刪除<br>
使用深度搜尋法尋訪所有節點<br>

#Data Table 資料表
The create data table sql<br>
資料表產生語法<br>

CREATE TABLE MyGuests (<br>
id INT(64) UNSIGNED AUTO_INCREMENT PRIMARY KEY,<br>
title VARCHAR(128) NOT NULL,<br>
parent int(64) NOT NULL,<br>
level int(32) NOT NULL,<br>
) 
