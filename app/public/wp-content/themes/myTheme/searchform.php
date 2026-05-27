<form action="/" method="get">
    <label for="search">Search:</label>
    <input type="text" name="s" id="search" value="<?php echo get_search_query(); ?>" required>
    <button type="submit">Search</button>
</form>