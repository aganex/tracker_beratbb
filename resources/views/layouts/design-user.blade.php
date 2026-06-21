{{--
    layouts/design-user.blade.php
    Shared styling for user-facing pages (Dashboard, dll).
    Include this once in layouts/app.blade.php, after Bootstrap CSS:

        @include('layouts.design-user')

--}}
<style>
.alert-card {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    border-radius: 14px;
    padding: 14px 18px;
    font-size: 0.88rem;
}

.alert-card--success {
    background: #e9f8ef;
    border: 1px solid #c8eed8;
    color: #1c8a4f;
}

.alert-card--danger {
    background: #fdecec;
    border: 1px solid #f7d3d3;
    color: #b33636;
}

.alert-card__icon {
    font-size: 1.05rem;
    margin-top: 1px;
    flex-shrink: 0;
}

.alert-card__list {
    margin: 0;
    padding-left: 18px;
}

.stat-card {
    background: #ffffff;
    border: 1px solid #eef1f6;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(20, 40, 80, 0.05);
    padding: 18px;
    display: flex;
    align-items: center;
    gap: 14px;
}

.stat-card__icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.05rem;
    flex-shrink: 0;
}

.stat-card__icon--blue {
    background: linear-gradient(135deg, rgba(28,163,224,0.12), rgba(99,102,241,0.12));
    color: #1ca3e0;
}

.stat-card__icon--cyan {
    background: rgba(13, 202, 240, 0.12);
    color: #0dcaf0;
}

.stat-card__icon--purple {
    background: rgba(99, 102, 241, 0.12);
    color: #6366f1;
}

.stat-card__icon--orange {
    background: rgba(245, 158, 11, 0.12);
    color: #d97706;
}

.stat-card__icon--green {
    background: rgba(34, 181, 115, 0.12);
    color: #22b573;
}

.stat-card__label {
    color: #8a93a3;
    font-size: 0.78rem;
    display: block;
}

.stat-card__value {
    margin: 0;
    font-weight: 700;
    color: #1a2233;
    font-size: 1.25rem;
}

.stat-card__unit {
    font-size: 0.8rem;
    color: #8a93a3;
    font-weight: 500;
}

.panel-card {
    background: #ffffff;
    border: 1px solid #eef1f6;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(20, 40, 80, 0.06);
    overflow: hidden;
}

.panel-card__head {
    padding: 16px 24px;
    border-bottom: 1px solid #eef1f6;
    font-weight: 700;
    font-size: 0.95rem;
    color: #1a2233;
}

.panel-card__body {
    padding: 22px 24px;
}

.info-label {
    color: #8a93a3;
    font-size: 0.8rem;
    display: block;
}

.info-value {
    font-weight: 600;
    color: #1a2233;
    font-size: 0.92rem;
}

.pill {
    font-size: 0.76rem;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 999px;
    display: inline-block;
}

.pill--green {
    background: rgba(34, 181, 115, 0.12);
    color: #1c8a4f;
}

.pill--orange {
    background: rgba(245, 158, 11, 0.12);
    color: #c9821a;
}

.pill--red {
    background: rgba(214, 69, 69, 0.12);
    color: #d64545;
}

.pill--blue {
    background: linear-gradient(135deg, rgba(28,163,224,0.12), rgba(99,102,241,0.12));
    color: #1ca3e0;
}

.field-label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: #5b6577;
    margin-bottom: 6px;
}

.field-input {
    width: 100%;
    border: 1px solid #eef1f6;
    background: #f8fafc;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.9rem;
    color: #1a2233;
    outline: none;
    transition: border-color 0.15s ease, background 0.15s ease;
}

.field-input:focus {
    border-color: #1ca3e0;
    background: #ffffff;
}

.field-input--error {
    border-color: #d64545;
    background: #fdecec;
}

.field-error {
    font-size: 0.78rem;
    color: #d64545;
    margin-top: 5px;
}

.submit-btn {
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #1ca3e0, #6366f1);
    color: #fff;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 11px 24px;
    transition: opacity 0.15s ease;
}

.submit-btn:hover {
    opacity: 0.9;
}

.table-scroll {
    max-height: 350px;
    overflow-y: auto;
}

.table-padded th,
.table-padded td {
    padding-left: 20px;
    padding-right: 20px;
}

.table-padded th:first-child,
.table-padded td:first-child {
    padding-left: 24px;
}

.table-padded thead th {
    background: #f8fafc;
    color: #5b6577;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: .02em;
    text-transform: uppercase;
    border-bottom: 1px solid #eef1f6;
    padding-top: 14px;
    padding-bottom: 14px;
}

.table-padded tbody td {
    font-size: 0.88rem;
    border-bottom: 1px solid #f3f5f9;
}

.diff {
    font-size: 0.85rem;
    font-weight: 600;
}

.diff--up {
    color: #d64545;
}

.diff--down {
    color: #22b573;
}

.diff--flat {
    color: #aab2c0;
}

.empty-state__icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: #eef1f6;
    color: #c3cbd9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    margin: 0 auto 12px;
}

.empty-state__title {
    color: #1a2233;
    font-weight: 600;
    font-size: 0.92rem;
}

.empty-state__desc {
    color: #8a93a3;
}
</style>