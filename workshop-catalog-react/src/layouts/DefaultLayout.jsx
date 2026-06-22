import { Link, Outlet } from "react-router-dom";

export function DefaultLayout() {
    return (
        <>
            <nav className="navbar navbar-expand-lg fixed-top navbar-corsorama">
                <div className="container">
                    <Link className="navbar-brand" to="/">
                        <span className="brand-logo">🎓</span>
                        <span className="brand-name">Corsorama</span>
                    </Link>
                    <ul className="navbar-nav ms-auto">
                        <li className="nav-item">
                            <Link className="nav-link nav-link-light" to="/">Catalogo</Link>
                        </li>
                    </ul>
                </div>
            </nav>
            <main style={{ paddingTop: '64px', minHeight: '100vh' }}>
                <Outlet />
            </main>
            <footer className="footer-corsorama py-4 mt-5">
                <div className="container text-center">
                    <p className="mb-1 fw-semibold">🎓 Corsorama</p>
                    <p className="mb-0 small opacity-75">© {new Date().getFullYear()} — Tutti i diritti riservati</p>
                </div>
            </footer>
        </>
    );
}
