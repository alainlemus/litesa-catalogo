import './bootstrap';

const root = document.documentElement;
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

/* ---------- Tema claro / oscuro ---------- */
function applyTheme(dark) {
    root.classList.toggle('dark', dark);
    try { localStorage.setItem('theme', dark ? 'dark' : 'light'); } catch (e) {}
    document.querySelectorAll('[data-theme-toggle]').forEach((btn) => {
        btn.setAttribute('aria-pressed', String(dark));
    });
}

function toggleTheme(event) {
    const dark = !root.classList.contains('dark');

    if (!document.startViewTransition || reduceMotion.matches) {
        applyTheme(dark);
        return;
    }

    const rect = event.currentTarget.getBoundingClientRect();
    const x = rect.left + rect.width / 2;
    const y = rect.top + rect.height / 2;
    const radius = Math.hypot(Math.max(x, innerWidth - x), Math.max(y, innerHeight - y));

    root.classList.add('theme-switching');
    const transition = document.startViewTransition(() => applyTheme(dark));

    transition.ready.then(() => {
        root.animate(
            { clipPath: [`circle(0px at ${x}px ${y}px)`, `circle(${radius}px at ${x}px ${y}px)`] },
            { duration: 550, easing: 'cubic-bezier(0.16, 1, 0.3, 1)', pseudoElement: '::view-transition-new(root)' },
        );
    });
    transition.finished.finally(() => root.classList.remove('theme-switching'));
}

document.addEventListener('click', (event) => {
    const btn = event.target.closest('[data-theme-toggle]');
    if (btn) toggleTheme({ currentTarget: btn });
});

document.querySelectorAll('[data-theme-toggle]').forEach((btn) => {
    btn.setAttribute('aria-pressed', String(root.classList.contains('dark')));
});

/* ---------- Header: sombra al hacer scroll ---------- */
const header = document.querySelector('.site-header');
if (header) {
    const onScroll = () => header.setAttribute('data-scrolled', String(window.scrollY > 8));
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

/* ---------- Halo que sigue al cursor en tarjetas .spotlight ---------- */
document.addEventListener('pointermove', (event) => {
    const card = event.target.closest?.('.spotlight');
    if (!card) return;
    const rect = card.getBoundingClientRect();
    card.style.setProperty('--mx', `${event.clientX - rect.left}px`);
    card.style.setProperty('--my', `${event.clientY - rect.top}px`);
}, { passive: true });

/* =====================================================================
   Interacciones
   ===================================================================== */
const canHover = window.matchMedia('(hover: hover) and (pointer: fine)');

/* ---------- Titulares palabra por palabra ---------- */
document.querySelectorAll('[data-split]').forEach((el) => {
    if (reduceMotion.matches) return;
    let index = 0;
    const walk = (node) => {
        [...node.childNodes].forEach((child) => {
            if (child.nodeType === 3) {
                const frag = document.createDocumentFragment();
                child.textContent.split(/(\s+)/).forEach((part) => {
                    if (!part.trim()) { frag.append(part); return; }
                    const outer = document.createElement('w-o');
                    outer.className = 'word';
                    const inner = document.createElement('w-i');
                    inner.className = 'w';
                    inner.style.setProperty('--w', index++);
                    inner.textContent = part;
                    outer.append(inner);
                    frag.append(outer);
                });
                child.replaceWith(frag);
            } else if (child.nodeType === 1) {
                walk(child);
            }
        });
    };
    el.setAttribute('aria-label', el.textContent.trim());
    walk(el);
    el.querySelectorAll('.word').forEach((w) => w.setAttribute('aria-hidden', 'true'));
});

/* ---------- Barras: progreso de scroll + carga de Livewire ---------- */
const progress = document.createElement('div');
progress.className = 'scroll-progress';
progress.setAttribute('aria-hidden', 'true');
const lwBar = document.createElement('div');
lwBar.className = 'lw-bar';
lwBar.setAttribute('aria-hidden', 'true');
document.body.prepend(progress, lwBar);

document.addEventListener('livewire:init', () => {
    let pending = 0;
    window.Livewire?.hook('commit', ({ respond, fail }) => {
        pending++;
        lwBar.classList.add('is-active');
        const done = () => { pending = Math.max(0, pending - 1); if (!pending) lwBar.classList.remove('is-active'); };
        respond(done);
        fail(done);
    });
});

/* ---------- Volver arriba ---------- */
const toTop = document.createElement('button');
toTop.type = 'button';
toTop.className = 'to-top';
toTop.setAttribute('aria-label', 'Volver arriba');
toTop.innerHTML = '<svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>';
toTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: reduceMotion.matches ? 'auto' : 'smooth' }));
document.body.append(toTop);
const toggleToTop = () => toTop.classList.toggle('is-visible', window.scrollY > 700);
toggleToTop();
window.addEventListener('scroll', toggleToTop, { passive: true });

/* ---------- Ripple en botones ---------- */
document.addEventListener('pointerdown', (event) => {
    const btn = event.target.closest('.btn-lumen, .btn-ghost, .btn-press');
    if (!btn || reduceMotion.matches) return;
    const rect = btn.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height) * 2;
    const dot = document.createElement('span');
    dot.className = 'ripple';
    dot.style.cssText = `width:${size}px;height:${size}px;left:${event.clientX - rect.left - size / 2}px;top:${event.clientY - rect.top - size / 2}px`;
    btn.append(dot);
    dot.addEventListener('animationend', () => dot.remove());
});

if (canHover.matches && !reduceMotion.matches) {
    /* ---------- Botones magnéticos ---------- */
    document.addEventListener('pointermove', (event) => {
        const btn = event.target.closest?.('.btn-lumen, .btn-ghost');
        if (!btn) return;
        const rect = btn.getBoundingClientRect();
        const x = (event.clientX - rect.left - rect.width / 2) * 0.18;
        const y = (event.clientY - rect.top - rect.height / 2) * 0.28;
        btn.style.translate = `${x}px ${y}px`;
    }, { passive: true });
    document.addEventListener('pointerout', (event) => {
        const btn = event.target.closest?.('.btn-lumen, .btn-ghost');
        if (btn && !btn.contains(event.relatedTarget)) btn.style.translate = '';
    });

    /* ---------- Tilt 3D ---------- */
    document.addEventListener('pointermove', (event) => {
        const el = event.target.closest?.('.tilt');
        if (!el) return;
        const rect = el.getBoundingClientRect();
        const px = (event.clientX - rect.left) / rect.width - 0.5;
        const py = (event.clientY - rect.top) / rect.height - 0.5;
        el.style.setProperty('--ry', `${px * 12}deg`);
        el.style.setProperty('--rx', `${-py * 12}deg`);
    }, { passive: true });
    document.addEventListener('pointerout', (event) => {
        const el = event.target.closest?.('.tilt');
        if (el && !el.contains(event.relatedTarget)) {
            el.style.setProperty('--rx', '0deg');
            el.style.setProperty('--ry', '0deg');
        }
    });

    /* ---------- Halo del hero ---------- */
    document.addEventListener('pointermove', (event) => {
        const hero = event.target.closest?.('[data-glow]');
        if (!hero) return;
        const rect = hero.getBoundingClientRect();
        hero.style.setProperty('--gx', `${event.clientX - rect.left}px`);
        hero.style.setProperty('--gy', `${event.clientY - rect.top}px`);
    }, { passive: true });

    /* ---------- Zoom de galería ---------- */
    document.addEventListener('pointermove', (event) => {
        const zone = event.target.closest?.('.zoom-follow');
        const img = zone?.querySelector('.swiper-slide-active img, img');
        if (!img) return;
        const rect = zone.getBoundingClientRect();
        img.style.transformOrigin = `${((event.clientX - rect.left) / rect.width) * 100}% ${((event.clientY - rect.top) / rect.height) * 100}%`;
    }, { passive: true });
}
