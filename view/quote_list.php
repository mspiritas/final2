<?php include('header.php')?>

<nav>
    <form action="." method="get">
        <section>
            <?php if ($authors) { ?>
            <label>Author:</label>
            <select name="author_id">
                <option value="0">View All Authors</option>
                <?php foreach ($authors as $author) : ?>
                <?php if ($author['id'] == $authorId) { ?>
                <option value="<?= $author['id']; ?>" selected>
                    <?php } else { ?>
                <option value="<?= $author['id']; ?>">
                    <?php } ?>
                    <?= $author['author']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php } ?>

            <?php if ($categories) { ?>
            <label>Category:</label>
            <select name="category_id">
                <option value="0">View All Categories</option>
                <?php foreach ($categories as $category) : ?>
                <?php if ($category['id'] == $categoryId) { ?>
                <option value="<?= $category['id']; ?>" selected>
                    <?php } else { ?>
                <option value="<?= $category['id']; ?>">
                    <?php } ?>
                    <?= $category['category']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php } ?>

            <?php if ($quotes) { ?>
            <label>Quote:</label>
            <select name="id">
                <option value="0">View All Quotes</option>
                <?php foreach ($quotes as $quote) : ?>
                <?php if ($quote['id'] == $quote) { ?>
                <option value="<?= $quote['id']; ?>" selected>
                    <?php } else { ?>
                <option value="<?= $quote['id']; ?>">
                    <?php } ?>
                    <?= $quote['quote']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php } ?>

        <section>
            <div>
                <span>Sort by: </span>
                <input type="radio" name="sort" value="author" 
                    <?php if ($sort === 'author') echo 'checked' ?>>
                <label>Author</label>
                <input type="radio" name="sort" value="category" 
                    <?php if ($sort === 'category') echo 'checked' ?>>
                <label>Category</label>
                <input type="submit" value="Submit">
            </div>
        </section>
    </form>
</nav>
<section>
    <?php if($all_quotes) { ?>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_quotes as $quote) : ?>
                <tr>
                    <td><?= $quote['author']; ?></td>
                    <?php if ($quote['author']) { ?>
                    <td><?= $quote['author']; ?></td>
                    <?php } else { ?>
                    <td>None</td>
                    <?php } ?>
                    <td><?= $quote['category']; ?></td>
                    <?php if ($quote['category']) { ?>
                    <td><?= $quote['category']; ?></td>
                    <?php } else { ?>
                    <td>None</td>
                    <?php } ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php } else { ?>
    <p>
        There are no matching quotes. Please try again.
    </p>
    <?php } ?>
</section>
<?php include('footer.php') ?>