<h2>Hello there , im Hosein Satari </h2>

<p>im <span style="color:#d90966">Back End Developer</span> , and this project for show my codes but this project is  not real </p>

<p>i use some Technology in this project</p>

<p>like :</p>
<ul>
      <li>RestFule api</li>
      <li>Graph Ql</li>
      <li>Test Driven Development</li>
      <li>sanctum authonticat</li>
</ul>

<pre>im going to have a <span style="color:#d90966">blog</span> in this project.

this blog is like other blogs but simple , this mean its have a table for <span style="color:#d90966">article</span> and a table for <span style="color:#d90966">category</span>

   in first i want make a test for database (insert and relationship) 

   and then i want to create migration and insert fake data by factory 

in api:

    for make account and authonticate user i make 2 route and controller for login and register

    then make a resource route and resource Controller in Version 1 api and then make 
    resource file for return data

in GraphQl:

   2 mutation for login and register
   
   2 query for get all article and single article

   and make some type for return data 
</pre>

<p>Routes : </p>

<pre>
<ul>
  <li>api/v1/register (post)
    <ul>
     <li>params : name ,email , password</li>   
     <li>return : name ,email </li> 
    </ul>
  </li>
<li>api/v1/login (post)
    <ul>
     <li>params : email , password</li>   
     <li>return : token </li> 
    </ul>
  </li>
<li>api/v1/articles (get) index
    <ul>
     <li>return : collection Article (title,body,poster , collectionCategory(title) ) </li> 
    </ul>
  </li>
<li>api/v1/articles/{article} (get) show
    <ul>
     <li>return : article Data </li> 
    </ul>
  </li>
<li>api/v1/articles (post) store (need authonticate)
    <ul>
 <li>params : title , body , poster , categories[]</li>   
     <li>return : article Data </li> 
    </ul>
  </li>
<li>api/v1/articles/{article} (patch) update (need authonticate)
    <ul>
 <li>params : title , body , poster , categories[]</li>   
     <li>return : article Data </li> 
    </ul>
  </li>

<li>api/v1/articles/{article} (delete) destroy (need authonticate)
    <ul>
     <li>return : status=boolean </li> 
    </ul>
  </li>
</ul>
</pre>

query GraphQl :
<pre>
<ul>
  <li>articles
   <ul>
    <li>data you can choose : title , body , poster , categories </li>
</ul>
 </li>
 <li>article
   <ul>
<li>params : id </li>
<li>data you can choose : title , body , poster , categories </li>
</ul>
 </li>
</ul>
</pre>
mutation GraphQl :
<pre>
<ul>
  <li>register
   <ul>
<li>params : name , email , password </li>
    <li>data you can choose : name , email </li>
</ul>
 </li>
 <li>login
   <ul>
<li>params : email , password </li>
<li>data you can choose : token </li>
</ul>
 </li>
</ul>
</pre>
