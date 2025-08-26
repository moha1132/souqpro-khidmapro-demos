(() => {
  const STORAGE_KEY = 'pref-theme';
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const saved = localStorage.getItem(STORAGE_KEY);
  const mode = saved || (prefersDark ? 'dark' : 'light');
  document.documentElement.dataset.theme = mode;
  document.querySelectorAll('.theme-toggle').forEach(el => {
    const setMode = (m) => {
      document.documentElement.dataset.theme = m;
      localStorage.setItem(STORAGE_KEY, m);
      el.dataset.mode = m;
    };
    el.dataset.mode = mode;
    el.addEventListener('click', () => setMode(el.dataset.mode === 'dark' ? 'light' : 'dark'));
  });
})();
