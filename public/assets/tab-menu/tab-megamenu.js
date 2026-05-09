const navItems  = document.querySelectorAll('.nav-item[data-menu]'); alert();
  const overlay   = document.getElementById('menu-overlay');
  let   activeKey = null;

  function openMenu(key) {
    closeAll();
    const item  = document.querySelector(`.nav-item[data-menu="${key}"]`);
    const panel = document.getElementById(key);
    if (!item || !panel) return;
    item.classList.add('open');
    panel.classList.add('open');
    overlay.classList.add('show');
    activeKey = key;
  }

  function closeAll() {
    navItems.forEach(i => i.classList.remove('open'));
    document.querySelectorAll('.mega-panel').forEach(p => p.classList.remove('open'));
    overlay.classList.remove('show');
    activeKey = null;
  }

  navItems.forEach(item => {
    const key = item.dataset.menu;
    item.querySelector('.nav-btn').addEventListener('click', e => {
      e.stopPropagation();
      activeKey === key ? closeAll() : openMenu(key); alert();
      document.querySelectorAll('.mega-first-child').forEach(el => {
        el.classList.add('active');
      });
    });
  });

  overlay.addEventListener('click', closeAll);

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeAll();
  });

  // Prevent mega panel clicks from closing
  document.querySelectorAll('.mega-panel').forEach(p => {
    p.addEventListener('click', e => e.stopPropagation());
  });

  // ── MARKETPLACE HORIZONTAL TABS ──
  const mktTabBtns  = document.querySelectorAll('.mkt-tab-btn[data-mkt-tab]');
  const mktTabPanes = document.querySelectorAll('.mkt-tab-pane');

  mktTabBtns.forEach(btn => {
    btn.addEventListener('click', e => {
      e.stopPropagation();
      const target = btn.dataset.mktTab;

      mktTabBtns.forEach(b => b.classList.remove('active'));
      //btn.classList.add('active');

      mktTabPanes.forEach(p => p.classList.remove('active'));
      const pane = document.getElementById(target);
      //if (pane) pane.classList.add('active');
      //document.querySelectorAll('.mega-first-child').classList.add('active');
      
      
    });
  });
  const devTabBtns  = document.querySelectorAll('.mega-tab-btn[data-tab]');
  const devTabPanes = document.querySelectorAll('.mega-tab-pane');

  devTabBtns.forEach(btn => {
    btn.addEventListener('click', e => {
      e.stopPropagation();
      const target = btn.dataset.tab;

      // Update buttons
      devTabBtns.forEach(b => b.classList.remove('active'));
      //btn.classList.add('active');

      // Update panes
      devTabPanes.forEach(p => p.classList.remove('active'));
      const pane = document.getElementById(target);
      //if (pane) pane.classList.add('active');
    });
  });