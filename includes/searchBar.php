<?php

echo '
<div class="search-container">
    <form action="/search.php">
        <input  id="searchInput" type="text" placeholder="Search..." name="searchInput" onkeyup="">
        <button id="buttonSearch" type="submit"><img src="../img/search.png"/></button>
    </form>
    <div id="searchResults">
    </div>  
</div>
    ';
