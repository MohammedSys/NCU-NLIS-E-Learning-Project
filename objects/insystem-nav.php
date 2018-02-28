<ul class="nav navbar-nav">
    <?php include 'objects/home-btn.php' ?>
</ul>
<form class="navbar-form navbar-left txt-white" role="search" method="get" action="search.php">
    <div class="form-group">
        <input id="searchInput" class="form-control" placeholder="搜尋" type="text" name="keyword" action="search.php"></input>
    </div>
    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
</form>