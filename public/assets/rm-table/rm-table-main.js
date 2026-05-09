
document.addEventListener('DOMContentLoaded', function () {

  var tbody       = document.getElementById('rm-tableBody');
  var searchInput = document.getElementById('rm-searchInput');
  var perPageEl   = document.getElementById('rm-perPage');
  var statusEl    = document.getElementById('rm-filterStatus');
  var pageInfo    = document.getElementById('rm-pageInfo');
  var pagesWrap   = document.getElementById('rm-pagesContainer');
  var emptyMsg    = document.getElementById('rm-emptyMsg');

  if (!tbody) return;

  var currentPage = 1;
  var sortColIdx  = null;
  var sortDir     = 1;

  /* Snapshot all rows ONCE — read text content now for reliable searching */
  var allRows = Array.from(tbody.querySelectorAll('tr[data-name]')).map(function (row) {
    return {
      el:        row,
      searchStr: row.textContent.toLowerCase().replace(/\s+/g, ' ').trim(),
      status:    row.dataset.status || 'active'
    };
  });

  /* ── Filter + Sort + Paginate ── */
  function applyAll() {
    var search = searchInput.value.toLowerCase().replace(/\s+/g, ' ').trim();
    var status = statusEl.value;

    /* 1. Filter */
    var visible = allRows.filter(function (item) {
      var matchS = status === 'all' || item.status === status;
      var matchQ = search === '' || item.searchStr.indexOf(search) !== -1;
      return matchS && matchQ;
    });

    /* 2. Sort */
    if (sortColIdx !== null) {
      visible.sort(function (a, b) {
        var va = a.el.cells[sortColIdx] ? a.el.cells[sortColIdx].textContent.trim().toLowerCase() : '';
        var vb = b.el.cells[sortColIdx] ? b.el.cells[sortColIdx].textContent.trim().toLowerCase() : '';
        return va < vb ? -sortDir : va > vb ? sortDir : 0;
      });
    }

    /* 3. Paginate */
    var perPage = Math.max(1, parseInt(perPageEl.value) || 10);
    var total   = visible.length;
    var pages   = Math.max(1, Math.ceil(total / perPage));
    currentPage = Math.min(currentPage, pages);
    var start   = (currentPage - 1) * perPage;
    var slice   = visible.slice(start, start + perPage);

    /* 4. Hide all, reorder, show slice */
    allRows.forEach(function (item) { item.el.classList.add('rm-hidden'); });
    visible.forEach(function (item) { tbody.appendChild(item.el); });
    slice.forEach(function (item, i) {
      item.el.cells[0].textContent = start + i + 1;
      item.el.classList.remove('rm-hidden');
    });

    /* 5. Empty message */
    emptyMsg.style.display = total === 0 ? '' : 'none';

    /* 6. Page info */
    pageInfo.textContent = total
      ? 'Showing ' + (start + 1) + ' to ' + Math.min(start + perPage, total) + ' of ' + total + ' results'
      : '';

    /* 7. Render pagination */
    renderPages(pages);
  }

  /* ── Pagination ── */
  function renderPages(pages) {
    pagesWrap.innerHTML = '';
    var nums = buildPageNums(currentPage, pages);

    var prev = makePageBtn('‹', currentPage === 1);
    prev.addEventListener('click', function () { if (currentPage > 1) { currentPage--; applyAll(); } });
    pagesWrap.appendChild(prev);

    nums.forEach(function (n) {
      if (n === '...') {
        var d = document.createElement('div');
        d.className = 'rm-page-btn rm-dots';
        d.textContent = '…';
        pagesWrap.appendChild(d);
      } else {
        var btn = makePageBtn(n, false);
        if (n === currentPage) btn.classList.add('rm-active');
        (function (page) {
          btn.addEventListener('click', function () { currentPage = page; applyAll(); });
        })(n);
        pagesWrap.appendChild(btn);
      }
    });

    var next = makePageBtn('›', currentPage === pages);
    next.addEventListener('click', function () { if (currentPage < pages) { currentPage++; applyAll(); } });
    pagesWrap.appendChild(next);
  }

  function makePageBtn(label, disabled) {
    var btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'rm-page-btn';
    btn.textContent = label;
    if (disabled) { btn.disabled = true; btn.style.opacity = '.4'; btn.style.cursor = 'not-allowed'; }
    return btn;
  }

  function buildPageNums(cur, total) {
    if (total <= 7) {
      var a = [];
      for (var x = 1; x <= total; x++) a.push(x);
      return a;
    }
    var arr = [1];
    if (cur > 3) arr.push('...');
    for (var i = Math.max(2, cur - 1); i <= Math.min(total - 1, cur + 1); i++) arr.push(i);
    if (cur < total - 2) arr.push('...');
    arr.push(total);
    return arr;
  }

  /* ── Sorting ── */
  document.querySelectorAll('#rm-empTable thead th.rm-sortable').forEach(function (th) {
    th.addEventListener('click', function () {
      var tdIdx = th.dataset.col === 'status' ? 2 : 1;
      if (sortColIdx === tdIdx) { sortDir *= -1; } else { sortColIdx = tdIdx; sortDir = 1; }
      currentPage = 1;
      applyAll();
    });
  });

  /* ── Export CSV ── */
  window.exportCSV = function () {
    var rows = [['#', 'Role Name', 'Status']];
    allRows.forEach(function (item, i) {
      rows.push([
        i + 1,
        item.el.cells[1] ? item.el.cells[1].textContent.trim() : '',
        item.status
      ]);
    });
    var csv = rows.map(function (r) { return r.join(','); }).join('\n');
    var a   = document.createElement('a');
    a.href  = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
    a.download = 'roles.csv';
    a.click();
  };

  /* ── Copy Table ── */
  window.copyTable = function () {
    var text = allRows.map(function (item) {
      return (item.el.cells[1] ? item.el.cells[1].textContent.trim() : '') + '\t' + item.status;
    }).join('\n');
    navigator.clipboard.writeText(text)
      .then(function () { alert('Table copied to clipboard!'); })
      .catch(function () { alert('Copy failed.'); });
  };

  /* ── Event Listeners ── */
  searchInput.addEventListener('input',  function () { currentPage = 1; applyAll(); });
  searchInput.addEventListener('keyup',  function () { currentPage = 1; applyAll(); });
  perPageEl  .addEventListener('change', function () { currentPage = 1; applyAll(); });
  statusEl   .addEventListener('change', function () { currentPage = 1; applyAll(); });

  applyAll();

});
