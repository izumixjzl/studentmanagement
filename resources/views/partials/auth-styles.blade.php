<style>
    :root {
        --brand: #0d6efd;
        --brand-dark: #0a58ca;
    }

    body {
        font-family: 'Ubuntu', sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background: linear-gradient(110deg, #e3f0fd 0%, #f3f1fb 55%, #f8e9f6 100%);
    }

    main {
        flex: 1;
        display: flex;
        align-items: center;
    }

    /* BRAND */

    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.4rem;
        font-weight: 300;
        letter-spacing: 6px;
        color: var(--brand);
    }

    .brand-logo {
        width: 34px;
        height: 34px;
        background: linear-gradient(135deg, #4d9bff, var(--brand));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        letter-spacing: 0;
        font-size: 1.2rem;
        transform: skewY(-6deg);
    }

    /* LEFT SIDE */

    .quote {
        font-size: 1.35rem;
        font-weight: 400;
        line-height: 1.5;
        color: #222;
        text-align: center;
        max-width: 380px;
        margin: 0 auto;
        position: relative;
    }

    .quote::before {
        content: '\201C';
        position: absolute;
        left: -22px;
        top: -14px;
        font-size: 2.6rem;
        font-weight: 500;
    }

    .illustration {
        max-width: 240px;
        width: 100%;
    }

    /* LOGIN CARD */

    .login-card {
        background: #fff;
        border-radius: 6px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        max-width: 360px;
        margin: 0 auto;
    }

    .login-header {
        position: relative;
        height: 110px;
        background: var(--brand);
    }

    .login-header::after {
        content: '';
        position: absolute;
        left: -10%;
        right: -10%;
        bottom: -60px;
        height: 120px;
        background: #fff;
        border-radius: 50% 50% 0 0;
    }

    .avatar {
        position: absolute;
        left: 50%;
        bottom: -30px;
        transform: translateX(-50%);
        width: 84px;
        height: 84px;
        border-radius: 50%;
        background: #fff;
        border: 3px solid #e9ecef;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.4rem;
        color: var(--brand);
        z-index: 1;
    }

    .login-body {
        padding: 40px 32px 30px;
    }

    .role-label {
        text-align: center;
        font-size: 0.85rem;
        color: #555;
        margin-bottom: 26px;
    }

    .line-input {
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid #ced4da;
        padding: 6px 0;
        margin-bottom: 24px;
        transition: border-color 0.2s;
    }

    .line-input:focus-within {
        border-color: var(--brand);
    }

    .line-input i {
        color: var(--brand);
        font-size: 1.1rem;
    }

    .line-input input {
        border: none;
        outline: none;
        flex: 1;
        font-size: 0.9rem;
        background: transparent;
    }

    .line-input input::placeholder {
        color: #aaa;
    }

    .options {
        font-size: 0.78rem;
        color: #555;
    }

    .btn-signin {
        background: var(--brand);
        color: #fff;
        border: none;
        padding: 7px 32px;
        border-radius: 3px;
        font-size: 0.9rem;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-signin:hover {
        background: var(--brand-dark);
        color: #fff;
    }

    .signup-link {
        font-size: 0.78rem;
        color: #555;
    }

    .signup-link a {
        text-decoration: none;
    }

    /* FOOTER */

    footer {
        background: #222;
        color: #ddd;
        font-size: 0.8rem;
        padding: 22px 0;
        text-align: center;
    }
</style>
