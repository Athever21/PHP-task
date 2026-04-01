<div class="products-container">
    <aside class="filters">        
        <h3>Filters</h3>
        <form method="GET">
            <div class="filter-group">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" placeholder="Search products...">
            </div>
            <div class="filter-group">
                <label for="category">Category</label>
                <select id="category" name="category">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['slug']) ?>" <?= ($_GET['category'] ?? '') === $category['slug'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Apply Filters</button>
        </form>
    </aside>
    <?php
    $searchValue = trim($_GET['search'] ?? '');
    $categoryValue = trim($_GET['category'] ?? '');
    $currentPage = (int) ($page ?? 1);
    $currentPage = $currentPage > 0 ? $currentPage : 1;
    ?>

    <main class="products-main">
        <div class="products-grid">
            <?php if (empty($products)): ?>
                <p>No products found.</p>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?= htmlspecialchars(empty($product['images']) ? 'https://via.placeholder.com/240x180/17171d/ffffff?text=No+Image' : $product['images'][0]) ?>" alt="<?= htmlspecialchars($product['title'] ?? 'Product') ?>">
                        </div>
                        <div class="product-details">
                            <h4><?= htmlspecialchars($product['title'] ?? 'Product') ?></h4>
                            <p class="product-price">Price: $<?= htmlspecialchars($product['price'] ?? 'N/A') ?></p>
                            <?php if (!empty($product['description'])): ?>
                                <p class="product-description"><?= htmlspecialchars($product['description']) ?></p>
                            <?php endif; ?>
                            <?php if (!empty($product['category'])): ?>
                                <p class="product-category">Category: <?= htmlspecialchars($product['category']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if (!empty($totalPages) && $totalPages > 1): ?>
            <div class="pagination">
                <?php
                $baseParams = [];
                if ($searchValue !== '') {
                    $baseParams['search'] = $searchValue;
                }
                if ($categoryValue !== '') {
                    $baseParams['category'] = $categoryValue;
                }
                $url = '/products';
                $maxVisible = 7;
                $visibleRange = 2;
                ?>

                <?php if ($currentPage > 1): ?>
                    <?php $prevParams = $baseParams; $prevParams['page'] = $currentPage - 1; ?>
                    <a href="<?= $url . '?' . http_build_query($prevParams) ?>" class="pagination-prev">&laquo; Previous</a>
                <?php endif; ?>

                <?php
                $start = 1;
                $end = $totalPages;

                if ($totalPages > $maxVisible) {
                    $start = 1;
                    $end = $totalPages;
                    $left = max(2, $currentPage - $visibleRange);
                    $right = min($totalPages - 1, $currentPage + $visibleRange);

                    if ($left <= 2) {
                        $left = 2;
                        $right = 1 + ($maxVisible - 2);
                    } elseif ($right >= $totalPages - 1) {
                        $right = $totalPages - 1;
                        $left = $totalPages - ($maxVisible - 1);
                    }
                } else {
                    $left = 2;
                    $right = $totalPages - 1;
                }
                ?>

                <?php // first page always shown ?>
                <?php $firstParams = $baseParams; $firstParams['page'] = 1; ?>
                <a href="<?= $url . '?' . http_build_query($firstParams) ?>" class="pagination-link <?= $currentPage === 1 ? 'active' : '' ?>">1</a>

                <?php if ($left > 2): ?>
                    <span class="pagination-ellipsis">&hellip;</span>
                <?php endif; ?>

                <?php for ($p = $left; $p <= $right; $p++): ?>
                    <?php $pageParams = $baseParams; $pageParams['page'] = $p; ?>
                    <a href="<?= $url . '?' . http_build_query($pageParams) ?>" class="pagination-link <?= $p === $currentPage ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>

                <?php if ($right < $totalPages - 1): ?>
                    <span class="pagination-ellipsis">&hellip;</span>
                <?php endif; ?>

                <?php if ($totalPages > 1): ?>
                    <?php $lastParams = $baseParams; $lastParams['page'] = $totalPages; ?>
                    <a href="<?= $url . '?' . http_build_query($lastParams) ?>" class="pagination-link <?= $currentPage === $totalPages ? 'active' : '' ?>"><?= $totalPages ?></a>
                <?php endif; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <?php $nextParams = $baseParams; $nextParams['page'] = $currentPage + 1; ?>
                    <a href="<?= $url . '?' . http_build_query($nextParams) ?>" class="pagination-next">Next &raquo;</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </main>
</div>
