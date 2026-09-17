import { Link, Outlet } from "react-router-dom";
import { LogIn } from "lucide-react";
import { loginUrl } from "../lib/api";

export function DefaultLayout() {
    return (
        <>
            <nav className="navbar navbar-expand-lg fixed-top navbar-corsorama">
                <div className="container">
                    <Link className="navbar-brand" to="/">
                        <span className="brand-logo">🎓</span>
                        <span className="brand-name">Corsorama</span>
                    </Link>
                    <ul className="navbar-nav ms-auto align-items-lg-center">
                        <li className="nav-item">
                            <Link className="nav-link nav-link-light" to="/">Home</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link nav-link-light" to="/courses">Catalogo</Link>
                        </li>
                        <li className="nav-item">
                            {/* Link esterno: il login vive ancora sul backoffice Laravel,
                                non nella SPA — per ora solo per l'admin. */}
                            <a href={loginUrl} className="nav-link-login">
                                <LogIn size={15} strokeWidth={2.5} />
                                Accedi
                            </a>
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
