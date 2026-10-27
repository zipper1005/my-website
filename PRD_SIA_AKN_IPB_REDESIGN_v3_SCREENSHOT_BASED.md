# PRD v3 — SIA AKN-IPB: Rebuild the Experience, Not Just the Styling

**Status:** Implementation-ready  
**Scope:** Login + authenticated application + all existing routes  
**Primary directive:** The current implementation is not approved. Redesign it based on the concrete issues below. Do not preserve the current layout merely because it exists.

## 1. Product design direction

Create a restrained, high-quality academic finance application. It should feel calm, precise, trustworthy, and usable for long work sessions.

**Design principle:** hierarchy before decoration. Every element must earn its place.

Visual direction:
- Warm off-white canvas, white content surfaces, deep ink text, restrained forest-green primary actions.
- One sans-serif UI family throughout. Use tabular numerals for money. Monospace only for account codes or reference IDs.
- Fine neutral borders, minimal shadows, moderate corner radii.
- No gradients, glowing effects, decorative status chips, oversized icons, excessive uppercase labels, or card-on-card nesting.
- Do not use a generic dashboard template. Establish a coherent composition and consistent spacing.

## 2. Issues visible in the current screenshots that must be fixed

### Dashboard
1. The pre-KPI area is cluttered: period, several actions, balance checks, journal audit, and entry count compete for attention.
2. The top bar is oversized and awkwardly aligned; the application name, period, notification, posting status, and administrator profile do not share a clean baseline.
3. Sidebar is too wide and visually heavy; logo/title wrapping is awkward and the bottom “Create Transaction” action is detached from the navigation structure.
4. The title/subtitle and muted text have weak contrast; the subtitle is too long and low-contrast.
5. KPI cards are oversized and repetitive. Their labels, icons, values, and descriptions lack consistent alignment.
6. The lower chart panels have too much header chrome and awkwardly wrapped descriptions/buttons.
7. The page is vertically crowded and requires excessive scrolling before reaching useful transaction detail.
8. Too many icon styles and status treatments are used at once.
9. Data period and values must be driven by the actual selected period and underlying data. Never hardcode figures to make the design look complete.

### Login
1. The left marketing panel contains too much copy and a faux “system status” feature panel.
2. The login card has too many badges, icons, borders, and labels.
3. The login field has an exaggerated focus outline in the captured state; define a clear but restrained focus ring.
4. The demo credential block exposes a username/password and even displays a “PROD” badge. Remove all visible credentials from production-facing UI. If demo access is needed, provide it only in a clearly separated development/demo environment and never mislabel it as production.
5. The brand lockup, typography, and spacing feel like a template. The login screen should be simple and trustworthy.

## 3. New design system

Create tokens and use them consistently. Adjust values if needed for contrast, but keep the restrained character.

```css
:root {
  --color-canvas: #F6F7F4;
  --color-surface: #FFFFFF;
  --color-surface-muted: #F0F3EF;
  --color-ink: #172923;
  --color-text-secondary: #64736B;
  --color-border: #DDE4DE;
  --color-primary: #245B45;
  --color-primary-hover: #1B4937;
  --color-primary-soft: #E7F0EA;
  --color-success: #26734D;
  --color-warning: #94631D;
  --color-danger: #A33E3E;
  --color-info: #315E88;
  --radius-sm: 6px;
  --radius-md: 9px;
  --radius-lg: 12px;
  --space-1: 4px;
  --space-2: 8px;
  --space-3: 12px;
  --space-4: 16px;
  --space-6: 24px;
  --space-8: 32px;
}
```

Typography:
- Use one UI font family already installed in the project; if none, use a suitable modern sans-serif with system fallbacks.
- Page title: 28–32 px, semibold.
- Section title: 16–18 px, semibold.
- Body and table: 13–14 px.
- Supporting text: 12–13 px, with enough contrast to remain readable.
- Money values: 24–30 px, tabular numerals.
- Avoid all-caps for normal labels; reserve it for very small section overlines, used sparingly.
- Do not mix multiple unrelated font families.

Spacing and surfaces:
- Use an 8 px spacing rhythm with 4 px subdivisions.
- Use borders as the main separation method; shadows only for overlays.
- No nested cards unless there is a clear functional reason.
- Maintain consistent alignment across every page.

## 4. Login screen redesign

Use a simple, balanced two-column layout on desktop and a single-column layout on mobile.

### Desktop
- Left panel: approximately 40–45% width, deep ink/forest background, original product wordmark, one concise headline, one short supporting paragraph, and at most one subtle abstract ledger-inspired graphic.
- Right panel: clean canvas with a centered form area, approximately 400–440 px wide.
- Form content order:
  1. “Masuk ke SIA”
  2. One short explanation
  3. Username/email field with persistent label
  4. Password field with show/hide control
  5. Forgot-password link only if the route/workflow exists
  6. Full-width primary login button
  7. Error/feedback region
- Keep the product identity and institutional label subtle and aligned.
- Remove the fake status panel, feature checklist, redundant badges, unnecessary icon boxes, and exposed demo credentials from production UI.
- Do not claim encryption, secure sessions, posting status, or other technical properties unless they are true and supported by the product.
- Do not create a “forgot password” link unless it works.

### Mobile
- One-column form; no 50/50 split.
- Brand lockup at top, short intro, then form.
- Comfortable side padding, no horizontal overflow.
- Keyboard focus and submit behavior must remain correct.

## 5. Authenticated app shell

### Sidebar
- Target width 224–240 px; collapsed width around 64–72 px if supported.
- Keep a compact product lockup at top; do not force the logo/title into many lines.
- Group existing routes by purpose, using only routes that exist.
- Active navigation uses a subtle tinted background and a slim accent marker—not a giant bright rectangle.
- Use one icon family with consistent 18 px sizing and stroke weight.
- Place user/profile and sign-out actions in a stable footer area if supported.
- Any “Create Transaction” shortcut must be placed consistently, not floating awkwardly at the bottom edge.
- Mobile sidebar becomes an accessible drawer.

### Top bar
- Target height around 56–64 px.
- Left: page breadcrumb or page title context.
- Right: selected accounting period if it applies, then real status/notifications, then user menu.
- Keep all items on one baseline. Do not repeat the period in multiple places without a reason.
- Remove placeholder notifications or decorative controls that do not perform a real action.

### Main content
- Desktop content max width around 1440 px, with 24–32 px horizontal padding.
- Page title and one-line description, then page actions.
- Keep page header compact. Use a predictable vertical rhythm.
- At common laptop widths, essential content should be visible without excessive scrolling.

## 6. Dashboard composition

Rebuild the dashboard in this order:

1. **Page header**
   - Title: “Ringkasan Keuangan”
   - One concise explanatory sentence.
   - Period selector and no more than two primary page actions.
2. **Accounting health strip**
   - Compact status line for balance checks and journal audit.
   - Show only valid results from existing data.
   - Use small text and semantic status indicators, not multiple full-width paragraphs.
   - If the source data or calculation is unavailable, show an honest unavailable state.
3. **Financial summary**
   - Up to four metrics: income, expenses, net result, transaction count, only when definitions/data exist.
   - Use equal card heights and aligned labels/values.
   - Do not use large decorative icons.
   - Descriptions should be short and consistent.
4. **Analysis section**
   - One main cashflow/balance trend visualization.
   - A secondary expense composition chart only if category data exists and the chart is meaningful.
   - Do not let chart titles, descriptions, legends, and action buttons wrap awkwardly.
   - Provide useful empty states rather than fabricated chart data.
5. **Recent transactions**
   - Put the transaction list/table high enough in the page to be useful.
   - Align date, description, type/status, and amount consistently.
   - Amounts right-aligned with tabular numerals.
   - “View all” only if the corresponding route exists.

Do not place long explanatory sentences inside KPI cards. Avoid a large number of summary panels competing with each other.

## 7. All other existing pages

Apply the same system to every current route, including transaction entry, journal, ledger, chart of accounts, reports, user management, settings, and any nested views that exist.

- Tables: readable density, clear headers, right-aligned numeric values, deliberate horizontal overflow or mobile row layout.
- Forms: persistent labels, consistent input heights, clear validation and help text.
- Filters: compact, visibly applied, resettable when supported.
- Modals: clear title, concise body, aligned actions, accessible focus management.
- Empty/loading/error states: consistent and honest.
- Buttons: primary, secondary, tertiary, danger; each must have hover, focus, active, disabled, and loading states.
- Do not add fake routes, fake actions, fake data, or decorative controls.

## 8. Responsive and accessibility requirements

- Desktop ≥1280 px: full sidebar; balanced multi-column dashboard.
- Tablet 768–1279 px: collapsible sidebar; KPI grid can become two columns.
- Mobile <768 px: drawer navigation; single-column content; forms stack; tables adapt intentionally.
- No page-level horizontal overflow.
- WCAG AA contrast as a target.
- Keyboard navigation and visible focus indicators.
- Icon-only controls have accessible labels.
- Reduced motion is respected.
- Status is not communicated by color alone.

## 9. Data integrity and security

- Do not modify backend, database schema, API contracts, authentication, authorization, role checks, accounting calculations, or source data.
- Never hardcode KPI values, dates, transactions, chart points, balances, or status.
- The selected period and every dashboard section must use a consistent source of truth.
- Investigate any discrepancy between displayed period and transaction dates; do not hide it through CSS or hardcoded labels.
- Do not show passwords, access tokens, or credentials in production UI, screenshots, logs, or source code. If credentials in the current screenshot are real, rotate them.
- Do not claim security features that the application has not implemented.
- Preserve existing working routes and behavior.

## 10. Mandatory implementation workflow

1. Inspect repository structure, framework, routes, existing UI, styles, and current uncommitted changes.
2. Map all existing routes and identify which components are shared.
3. Implement the design tokens and shared components first.
4. Rebuild login and app shell, then dashboard, then every other existing route.
5. Remove obsolete styling only after confirming it is no longer used. Avoid layering endless overrides on top of old CSS.
6. Run lint, typecheck, tests, and build using the project's actual scripts.
7. Run the app and inspect the login and authenticated pages at desktop and mobile sizes.
8. Capture before/after screenshots if browser tooling is available and verify that the result is visibly different.
9. Fix obvious layout, alignment, overflow, contrast, and wrapping issues before reporting completion.

## 11. Definition of done

- [ ] Login has been simplified and redesigned; no exposed demo password or fake production label.
- [ ] Sidebar and topbar are compact, aligned, and consistent.
- [ ] Dashboard hierarchy is clear; status information is compact; KPI cards are aligned.
- [ ] Chart panels and transaction table have clean proportions and spacing.
- [ ] Every existing route uses the same design system.
- [ ] No fake data or nonfunctional controls have been introduced.
- [ ] Period, transactions, and financial figures remain consistent with real data.
- [ ] Mobile and desktop layouts have been inspected.
- [ ] Existing backend and business behavior remain unchanged.
- [ ] Available checks have been run and results reported.
- [ ] Visual proof is supplied if tooling allows.

## 12. Coding agent execution prompt

Do not merely explain what should change. Implement this PRD directly.

The current UI shown in the supplied screenshots is rejected. Perform a real rebuild of the visual hierarchy and layout for both login and the authenticated application. The main defects to address are excessive clutter, weak text contrast, inconsistent typography, oversized sidebar/header, oversized repetitive KPI cards, crowded status text, awkward chart panel wrapping, and a login screen overloaded with badges and marketing content.

Audit the existing project and local changes first. Preserve valid work, all existing routes and working behavior, backend/API/database, authentication, authorization, and accounting logic. Use real data only. Remove demo credentials from production-facing UI and never expose secrets. Do not stop after adding CSS tokens or updating a single page: implement the design system across every existing route, test it, run the available checks, inspect desktop/mobile renderings, and report concrete files changed plus any remaining defects.
