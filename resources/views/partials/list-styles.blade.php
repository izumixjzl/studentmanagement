<style>
    :root {
        --sl-purple: #7a1fd6;
        --sl-purple-dark: #6418b3;
        --sl-purple-soft: #f4ecfd;
        --sl-text: #2b2b3a;
        --sl-muted: #8a8a9a;
        --sl-border: #eeeef3;
    }

    .sl-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--sl-text);
        margin-bottom: 2px;
    }

    .sl-breadcrumb {
        font-size: 0.85rem;
        color: var(--sl-muted);
    }

    .sl-breadcrumb a {
        color: var(--sl-muted);
        text-decoration: none;
    }

    .sl-breadcrumb .current {
        color: var(--sl-text);
    }

    .btn-sl {
        background: var(--sl-purple);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 9px 20px;
        font-size: 0.9rem;
    }

    .btn-sl:hover {
        background: var(--sl-purple-dark);
        color: #fff;
    }

    .sl-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(30, 30, 60, 0.05);
        padding: 18px 16px 8px;
    }

    .sl-card-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--sl-text);
        margin: 0;
    }

    .sl-search {
        display: flex;
        align-items: center;
        background: #f7f7fa;
        border-radius: 6px;
        padding: 0 10px;
        width: 220px;
    }

    .sl-search input {
        border: none;
        background: transparent;
        outline: none;
        font-size: 0.8rem;
        padding: 7px 4px;
        flex: 1;
        min-width: 0;
    }

    .sl-search button {
        border: none;
        background: none;
        color: var(--sl-purple);
        padding: 0;
    }

    .sl-select {
        font-size: 0.8rem;
        border: 1px solid var(--sl-border);
        border-radius: 6px;
        color: #555;
        padding: 6px 28px 6px 10px;
        background-color: #fff;
    }

    .sl-table {
        font-size: 0.82rem;
        color: #444;
        margin-bottom: 0;
    }

    .sl-table thead th {
        background: var(--sl-purple-soft);
        color: #6b6b7b;
        font-weight: 500;
        font-size: 0.75rem;
        text-transform: uppercase;
        border: none;
        padding: 12px 10px;
        white-space: nowrap;
    }

    .sl-table thead th:first-child {
        border-radius: 6px 0 0 6px;
    }

    .sl-table thead th:last-child {
        border-radius: 0 6px 6px 0;
    }

    .sl-table tbody td {
        border-bottom: 1px solid var(--sl-border);
        padding: 12px 10px;
        vertical-align: middle;
    }

    .sl-table tbody tr {
        transition: box-shadow 0.15s;
    }

    .sl-table tbody tr:hover,
    .sl-table tbody tr.selected {
        box-shadow: 0 2px 12px rgba(30, 30, 60, 0.08);
    }

    .sl-table .form-check-input {
        width: 1.05em;
        height: 1.05em;
        cursor: pointer;
    }

    .sl-table .form-check-input:checked {
        background-color: var(--sl-purple);
        border-color: var(--sl-purple);
    }

    .sl-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
        color: #fff;
        flex-shrink: 0;
    }

    .sl-name {
        color: var(--sl-text);
        text-decoration: none;
    }

    .sl-name:hover {
        color: var(--sl-purple);
    }

    .sl-action {
        background: none;
        border: none;
        color: #777;
        padding: 0 4px;
        font-size: 1rem;
        text-decoration: none;
    }

    .sl-action:hover {
        color: var(--sl-purple);
    }

    .sl-action.delete:hover {
        color: #dc3545;
    }

    /* PAGINATION */

    .sl-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 22px;
        flex-wrap: wrap;
    }

    .sl-page {
        min-width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        font-size: 0.8rem;
        color: #444;
        text-decoration: none;
    }

    a.sl-page:hover {
        background: var(--sl-purple-soft);
        color: var(--sl-purple);
    }

    .sl-page.active {
        background: var(--sl-purple);
        color: #fff;
    }

    .sl-page.disabled {
        color: #ccc;
    }
</style>
