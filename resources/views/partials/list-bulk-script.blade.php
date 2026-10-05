<script>
    (function () {
        const selectAll = document.getElementById('select-all');
        const checks = document.querySelectorAll('.row-check');
        const bulkBtn = document.getElementById('bulk-delete');
        const bulkCount = document.getElementById('bulk-count');

        function refresh() {
            const selected = [...checks].filter(c => c.checked);

            checks.forEach(c => c.closest('tr').classList.toggle('selected', c.checked));

            bulkCount.textContent = selected.length;
            bulkBtn.classList.toggle('d-none', selected.length === 0);

            if (selectAll) {
                selectAll.checked = selected.length > 0 && selected.length === checks.length;
                selectAll.indeterminate = selected.length > 0 && selected.length < checks.length;
            }
        }

        if (selectAll) {
            selectAll.addEventListener('change', () => {
                checks.forEach(c => c.checked = selectAll.checked);
                refresh();
            });
        }

        checks.forEach(c => c.addEventListener('change', refresh));
    })();
</script>
