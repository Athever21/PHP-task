<?php

namespace App\Queries;

class ProductQuery {
    private ?string $category = null;
    private ?string $search = null;
    private int $page = 1;
    private int $limit = 12;

    public static function make(): self {
        return new self();
    }

    public function category(?string $category): self {
        $this->category = $category ?: null;
        return $this;
    }

    public function search(?string $search): self {
        $this->search = $search ? trim($search) : null;
        return $this;
    }

    public function page(int $page): self {
        $this->page = max(1, $page);
        return $this;
    }

    public function limit(int $limit): self {
        $this->limit = $limit;
        return $this;
    }

    public function getCategory(): ?string {
        return $this->category;
    }

    public function getSearch(): ?string {
        return $this->search;
    }

    public function getPage(): int {
        return ($this->page - 1) * $this->limit;
    }

    public function getLimit(): int {
        return $this->limit;
    }

    public function getPageNumber(): int {
        return $this->page;
    }

    public function toRequest(string $baseUrl): array {
        $params = [
            'limit' => $this->limit,
            'skip' => $this->getPage(),
        ];

        if ($this->search !== null) {
            return [
                'url' => $baseUrl . '/search',
                'params' => [
                    ...$params,
                    'q' => $this->search,
                ],
            ];
        }

        if ($this->category !== null) {
            return [
                'url' => $baseUrl . '/category/' . urlencode($this->category),
                'params' => $params,
            ];
        }

        return [
            'url' => $baseUrl,
            'params' => $params,
        ];
    }
}
