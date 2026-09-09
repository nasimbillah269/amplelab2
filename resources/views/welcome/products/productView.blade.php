@extends(welcomeTheme().'layouts.app')

@section('title')
<title>{{websiteTitle($product->seo_title?:$product->name)}}</title>
@endsection

@section('SEO')
<meta name="title" property="og:title" content="{{$product->seo_title?:websiteTitle($product->name)}}" />
<meta name="description" property="og:description" content="{{$product->seo_description?:$product->short_description}}" />
<meta name="keywords" content="{{$product->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{assetUrl($product->image())}}" />
<meta name="url" property="og:url" content="{{route('productView',$product->slug?:'no-title')}}" />
<link class="canonical" href="{{route('productView',$product->slug?:'no-title')}}">
@endsection

@push('css')
<style>



/* ==========================================================================
   Nuvesta Product Details - Minimal Flat Styling System
   Font Family: Poppins (Google Fonts)
   Architecture: Modular, BEM-inspired scalable classes
   ========================================================================== */

/* --------------------------------------------------------------------------
   1. Design System & CSS Variables
   -------------------------------------------------------------------------- */
:root {
  --color-primary: #00a8b5;
  --color-primary-hover: #008894;
  --color-dark: #111111;
  --color-slate-800: #18181b;
  --color-slate-700: #27272a;
  --color-slate-600: #52525b;
  --color-slate-500: #71717a;
  --color-slate-400: #a1a1aa;
  --color-slate-300: #d4d4d8;
  --color-slate-200: #e4e4e7;
  --color-slate-100: #f4f4f5;
  --color-bg-light: #fafafa;
  --color-white: #ffffff;
  --color-red: #ef4444;
  
  --font-family: 'Poppins', sans-serif;
  --border-flat: 1px solid var(--color-slate-200);
  --border-dark: 1px solid var(--color-dark);
  --transition-smooth: all 0.3s ease-in-out;
  --radius-sm: 4px;
  --radius-md: 8px;
}

/* Global Reset & Typography */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  box-shadow: none !important;
}

body {
  font-family: var(--font-family);
  background-color: var(--color-bg-light);
  color: var(--color-slate-800);
  line-height: 1.5;
  -webkit-font-smoothing: antialiased;
}

a {
  text-decoration: none;
  color: inherit;
}

/* --------------------------------------------------------------------------
   2. Page Container & Breadcrumbs
   -------------------------------------------------------------------------- */
.detail-page-wrapper {
  padding-top: 1.5rem;
  padding-bottom: 4rem;
}

.detail-breadcrumb-card {
  background-color: var(--color-white);
  border: var(--border-flat);
  border-radius: var(--radius-md);
  margin-bottom: 0.75rem;
  padding: 10px 10px;
}

.detail-breadcrumb-list {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 0.4rem;
  list-style: none;
  margin: 0;
  padding: 0;
}

.detail-breadcrumb-item {
  display: inline-flex;
  align-items: center;
  font-size: 0.825rem;
  font-weight: 500;
  color: var(--color-slate-500);
}

.detail-breadcrumb-link {
  color: var(--color-slate-600);
  transition: var(--transition-smooth);
}

.detail-breadcrumb-link:hover {
  color: var(--color-primary);
}

.detail-breadcrumb-separator {
  margin: 0 0.2rem;
  color: var(--color-slate-400);
  font-size: 0.7rem;
}

.detail-breadcrumb-item.active {
  color: var(--color-dark);
  font-weight: 600;
}

/* --------------------------------------------------------------------------
   3. Main Product Details Layout Card
   -------------------------------------------------------------------------- */
.detail-main-card {
  background-color: var(--color-white);
  border: var(--border-flat);
  border-radius: var(--radius-md);
  padding: 1.5rem;
  margin-bottom: 0;
}

/* --------------------------------------------------------------------------
   4. Gallery & Media Column (Left)
   -------------------------------------------------------------------------- */
.detail-media-container {
  display: flex;
  flex-direction: column;
  gap: 0.85rem;
}

.detail-main-stage {
  position: relative;
  width: 100%;
  padding-top: 125%;
  overflow: hidden;
  background-color: var(--color-slate-100);
  border: var(--border-flat);
}

.detail-stage-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: var(--transition-smooth);
}

.detail-video-btn {
  position: absolute;
  bottom: 1rem;
  right: 1rem;
  z-index: 3;
  background-color: var(--color-white);
  color: var(--color-dark);
  border: var(--border-flat);
  font-size: 0.75rem;
  font-weight: 600;
  font-family: var(--font-family);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  padding: 0.45rem 0.95rem;
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  cursor: pointer;
  transition: var(--transition-smooth);
}

.detail-video-btn:hover {
  background-color: var(--color-dark);
  color: var(--color-white);
}

.detail-thumb-strip {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 0.5rem;
}

.detail-thumb-box {
  position: relative;
  width: 100%;
  padding-top: 120%;
  overflow: hidden;
  border: 1px solid var(--color-slate-200);
  cursor: pointer;
  transition: var(--transition-smooth);
  background-color: var(--color-slate-100);
}

.detail-thumb-box:hover,
.detail-thumb-box.active {
  border-color: var(--color-primary);
}

.detail-thumb-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* --------------------------------------------------------------------------
   5. Main Info Column (Right)
   -------------------------------------------------------------------------- */
.detail-info-container {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.detail-title-header {
  display: flex;
  align-items: baseline;
  justify-content: space-between;
  gap: 0.75rem;
  flex-wrap: wrap;
  padding-bottom: 0.75rem;
  border-bottom: var(--border-flat);
}

.detail-title-group {
  display: flex;
  align-items: baseline;
  gap: 0.6rem;
  flex-wrap: wrap;
}

.detail-prod-title {
  font-size: 22px;
  font-weight: 500;
  color: var(--color-dark);
  text-transform: uppercase;
  letter-spacing: -0.02em;
  margin: 0;
}

.detail-prod-code {
  font-size: 1.2rem;
  font-weight: 500;
  color: var(--color-primary);
}

.detail-header-actions {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.detail-action-icon-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background-color: var(--color-slate-100);
  color: var(--color-primary);
  border: 1px solid var(--color-slate-200);
  font-size: 0.875rem;
  cursor: pointer;
  transition: var(--transition-smooth);
}

.detail-action-icon-btn:hover {
  background-color: var(--color-primary);
  color: var(--color-white);
  border-color: var(--color-primary);
}

.detail-subtitle-spec {
  font-size: 0.85rem;
  color: var(--color-slate-600);
  font-weight: 500;
}

.detail-subtitle-spec span {
  display: block;
  font-size: 0.8rem;
  color: var(--color-slate-500);
}

/* Color Swatches Selector */
.detail-option-section {
  display: flex;
  flex-direction: column;
  gap: 0.6rem;
}

.detail-option-label-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.detail-option-title {
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--color-dark);
  text-transform: uppercase;
  letter-spacing: 0.03em;
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
}

.detail-swatch-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 0.45rem;
}

.detail-swatch-btn {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  border: 1px solid var(--color-slate-300);
  cursor: pointer;
  transition: var(--transition-smooth);
  position: relative;
}

.detail-swatch-btn:hover,
.detail-swatch-btn.active {
  transform: scale(1.25);
  border-color: var(--color-dark);
}

/* Size Selector Grid */
.detail-size-guide-link {
  font-size: 0.8rem;
  color: var(--color-dark);
  font-weight: 600;
  text-decoration: underline;
  cursor: pointer;
}

.detail-size-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 0.4rem;
}

.detail-size-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.4rem 0.8rem;
  background-color: var(--color-slate-100);
  border: 1px solid var(--color-slate-200);
  font-size: 0.8rem;
  font-weight: 500;
  color: var(--color-slate-700);
  cursor: pointer;
  transition: var(--transition-smooth);
}

.detail-size-btn:hover {
  background-color: var(--color-slate-200);
  color: var(--color-dark);
}

.detail-size-btn.active {
  background-color: var(--color-dark);
  color: var(--color-white);
  border-color: var(--color-dark);
}

.detail-size-note {
  font-size: 0.72rem;
  color: var(--color-slate-500);
  font-style: italic;
}

/* Teal Price Callout Banner */
.detail-price-banner {
  background-color: #e43a59;
  color: var(--color-white);
  padding: 0.85rem 1.25rem;
  text-align: center;
  cursor: pointer;
  transition: var(--transition-smooth);
}

.detail-price-banner:hover {
  background-color: var(--color-primary-hover);
}

.detail-price-banner-title {
  font-size: 0.95rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  margin: 0;
  color: #fff;
}

.detail-price-banner-sub {
  font-size: 0.75rem;
  font-weight: 400;
  opacity: 0.9;
  display: block;
  color: #fff;
}

/* Doc Pill Actions (User Customized) */
.detail-docs-flex {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.detail-doc-pill {
  display: inline-flex;
  align-items: center;
  gap: 0.45rem;
  background-color: var(--color-slate-100);
  color: var(--color-slate-700);
  border: 1px solid var(--color-slate-200);
  border-radius: 2px;
  padding: 0.45rem 0.95rem;
  font-size: 10px;
  font-weight: 500;
  cursor: pointer;
  transition: var(--transition-smooth);
}

.detail-doc-pill:hover {
  background-color: var(--color-dark);
  color: var(--color-white);
}

/* --------------------------------------------------------------------------
   6. Short Description Section
   -------------------------------------------------------------------------- */
.detail-short-desc {
  border-top: var(--border-flat);
  padding-top: 1rem;
}

.detail-short-desc-title {
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--color-dark);
  text-transform: uppercase;
  letter-spacing: 0.03em;
  margin-bottom: 0.4rem;
}

.detail-short-desc-text {
  font-size: 0.825rem;
  color: var(--color-slate-600);
  line-height: 1.6;
  margin: 0;
}

/* --------------------------------------------------------------------------
   7. Social Media Sharing Row
   -------------------------------------------------------------------------- */
.detail-social-share-row {
  display: flex;
  align-items: center;
  gap: 0.85rem;
  flex-wrap: wrap;
}

.detail-social-label {
  font-size: 0.825rem;
  font-weight: 600;
  color: var(--color-dark);
}

.detail-social-icons-list {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  list-style: none;
  margin: 0;
  padding: 0;
}

.detail-social-icon-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background-color: var(--color-slate-100);
  color: var(--color-slate-700);
  border: 1px solid var(--color-slate-200);
  font-size: 0.85rem;
  transition: var(--transition-smooth);
}

.detail-social-icon-btn:hover {
  background-color: var(--color-primary);
  color: var(--color-white);
  border-color: var(--color-primary);
}

/* --------------------------------------------------------------------------
   8. Full Details Tabbed Section (Spacious Modern Design)
   -------------------------------------------------------------------------- */
.detail-tabs-wrapper {
  background-color: var(--color-white);
  border: var(--border-flat);
  border-radius: var(--radius-md);
  margin-top: 2.5rem;
  margin-bottom: 3rem;
  padding: 2rem 2.25rem;
}

.detail-nav-tabs {
  display: flex;
  align-items: center;
  gap: 2rem;
  border-bottom: 2px solid var(--color-slate-200);
  margin-bottom: 2rem;
  list-style: none;
  padding: 0;
  flex-wrap: wrap;
}

.detail-tab-item {
  margin-bottom: -2px;
}

.detail-tab-btn {
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--color-slate-500);
  text-transform: uppercase;
  letter-spacing: 0.04em;
  padding: 0.75rem 0.5rem 1rem 0.5rem;
  border: none;
  background: none;
  border-bottom: 2px solid transparent;
  cursor: pointer;
  font-family: var(--font-family);
  transition: var(--transition-smooth);
}

.detail-tab-btn:hover {
  color: var(--color-dark);
}

.detail-tab-btn.active {
  color: var(--color-primary);
  border-bottom-color: var(--color-primary);
}

.detail-tab-content-box {
  padding-top: 0.5rem;
}

.detail-tab-paragraph {
  font-size: 0.9rem;
  color: var(--color-slate-600);
  line-height: 1.8;
  margin-bottom: 1.25rem;
}

/* Spacious Tables Styling */
.detail-data-table-wrapper {
  width: 100%;
  overflow-x: auto;
}

.detail-data-table {
  width: 100%;
  border-collapse: collapse;
}

.detail-data-table th,
.detail-data-table td {
  border: var(--border-flat);
  padding: 0.95rem 1.25rem;
  font-size: 0.875rem;
  vertical-align: middle;
}

.detail-data-table th {
  background-color: var(--color-dark);
  color: var(--color-white);
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.02em;
}

.detail-data-table tbody tr {
  transition: var(--transition-smooth);
}

.detail-data-table tbody tr:hover {
  background-color: var(--color-slate-100);
}

.detail-data-table td {
  color: var(--color-slate-700);
}

.detail-data-table-label {
  font-weight: 600;
  color: var(--color-dark);
  width: 30%;
  background-color: var(--color-slate-100);
}

/* --------------------------------------------------------------------------
   9. Related Products Section Cards (Pixel Perfect Match to Catalog)
   -------------------------------------------------------------------------- */
.detail-related-section {
  margin-top: 3rem;
}

.detail-related-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--color-dark);
  margin-bottom: 1.5rem;
  text-transform: uppercase;
  letter-spacing: -0.01em;
}

/* Card Anchor & Structure */
.prod-card-anchor {
  display: block;
  height: 100%;
  color: inherit;
}

.prod-card {
  background-color: var(--color-white);
  border: var(--border-flat);
  border-radius: 0;
  overflow: hidden;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: var(--transition-smooth);
}

.prod-card-anchor:hover .prod-card {
  border-color: var(--color-dark);
}

/* Media Box Aspect Ratio (Tall Portrait ~ 130%) */
.prod-media-wrapper {
  position: relative;
  width: 100%;
  padding-top: 130%;
  overflow: hidden;
  background-color: var(--color-slate-100);
}

.prod-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: opacity 0.4s ease-in-out, transform 0.4s ease-in-out;
}

.prod-image-primary {
  opacity: 1;
  z-index: 1;
}

.prod-image-secondary {
  opacity: 0;
  z-index: 2;
}

.prod-card-anchor:hover .prod-image-primary {
  opacity: 0;
}

.prod-card-anchor:hover .prod-image-secondary {
  opacity: 1;
  transform: scale(1.03);
}

.prod-badge-pill {
  position: absolute;
  top: 0.85rem;
  left: 0.85rem;
  z-index: 3;
  background-color: var(--color-dark);
  color: var(--color-white);
  font-size: 0.78rem;
  font-weight: 600;
  padding: 0.25rem 0.85rem;
  border-radius: 30px;
  line-height: 1.2;
}

.prod-brand-watermark {
  position: absolute;
  bottom: 0.85rem;
  right: 0.85rem;
  z-index: 3;
  color: rgba(0, 0, 0, 0.45);
  font-size: 1.4rem;
  pointer-events: none;
}

.prod-content-body {
  padding: 1rem 0.85rem;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.prod-title-group {
  display: flex;
  align-items: baseline;
  gap: 0.5rem;
  margin-bottom: 0.25rem;
  flex-wrap: wrap;
}

.prod-code {
  color: var(--color-primary);
  font-weight: 300;
  font-size: 15px;
}

.prod-title {
  color: var(--color-dark);
  font-weight: 300;
  font-size: 15px;
  text-transform: uppercase;
  margin: 0;
  transition: var(--transition-smooth);
}

.prod-card-anchor:hover .prod-title {
  color: var(--color-primary);
}

.prod-subtitle {
  font-size: 0.95rem;
  font-style: italic;
  color: #5f5f67f0;
  margin-bottom: 5px;
  font-weight: 300;
}

.prod-specs-info {
  font-size: 0.9rem;
  font-style: italic;
  color: var(--color-slate-500);
  font-weight: 400;
}

/* 5-Column helper rule */
@media (min-width: 992px) {
  .col-lg-2-4 {
    flex: 0 0 auto;
    width: 20%;
  }
}

/* --------------------------------------------------------------------------
   10. Responsive Design Breakpoints
   -------------------------------------------------------------------------- */
@media (max-width: 767.98px) {
  .detail-main-card,
  .detail-tabs-wrapper {
    padding: 1.25rem 1rem;
  }
  
  .detail-nav-tabs {
    gap: 1rem;
  }
}




ul.colorList{
    display:inline-block;
    margin-top:0;
    padding: 0;
    margin-bottom: 0;
}

ul.colorList li{
    background-color: unset;
    color:unset;
    float: left;
    padding:0;
    padding-right: 10px;
}

.attributeItem .colorItem {
    height: 25px;
    width: 25px;
    border-radius: 100%;
    cursor:pointer;
    margin-bottom: 5px;
     border: 1px solid #cdc9c9;
    
}

.attributeItem .colorItem.active {
    box-shadow: 0px 1px 8px 2px #444;
    transition: 0.4s;
    border: 1px solid #000;
}

.attributeItem .textItem {
    /*height: 25px;*/
    min-width: 25px;
    background: #f1f1f1;
    text-align: center;
    padding: 10px 15px;
    text-transform: uppercase;
    cursor: pointer;
    border: 1px solid #e9dce2;
    margin-bottom: 5px;
    line-height: 18px;
}

.attributeItem .textItem.active {
       color: #fff;
    background: #000;
}

.attributeItem .imageItem {
    margin-bottom: 5px;
}

.attributeItem .imageItem img {
    width: 25px;
    height: 25px;
    border-radius: 5px;
    border: 1px solid #dfdede;
    padding: 1px;
}

.attributeItem .imageItem.active img {
    border-color: #0ba350;
}

.attributeValue {
    width: 1px;
    position: absolute;
    z-index: -9;
}





.colorList .colorItem {
  position: relative;
}

.colorList .colorItem::after {
  content: attr(data-vari); /* Use the data-name attribute as tooltip text */
  position: absolute;
  top: -30px; /* Position above the label */
  left: 50%;
  transform: translateX(-50%);
  background-color: black;
  color: white;
  padding: 5px 10px;
  font-size: 12px;
  border-radius: 4px;
  white-space: nowrap;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease-in-out;
}

.colorList .colorItem:hover::after {
  opacity: 1;
  visibility: visible;
}



.smalOtherBox h5 {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--color-dark);
    text-transform: uppercase;
    letter-spacing: 0.03em;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}




/* =============================================
   PRODUCT ZOOM & GALLERY THUMBNAILS
   ============================================= */
.mgmt-detail-img-zoom-wrap {
    position: relative;
    cursor: crosshair;
    border: 1px solid var(--mgmt-border, #eeeeee);
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
}

.mgmt-detail-img-zoom-wrap img {
    width: 100%;
    height: auto;
    object-fit: contain;
    display: block;
    pointer-events: none;
}

/* Zoom Lens */
.mgmt-zoom-lens {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 120px;
    height: 120px;
    border: 2px solid var(--mgmt-accent, #6a4914);
    background-color: rgba(255,255,255,0.3);
    pointer-events: none;
    z-index: 5;
}

/* Zoom Result (zoomed view) */
.mgmt-zoom-result {
    display: none;
    position: absolute;
    top: 0;
    width: 600px;
    height: 800px;
    border: 1px solid #ddd;
    background-repeat: no-repeat;
    background-size: 200%;
    background-color: #fff;
    z-index: 10;
    box-shadow: 0 4px 16px rgba(0,0,0,0.12);
}

@media (max-width: 1199.98px) {
    .mgmt-zoom-result {
        width: 300px;
        height: 300px;
    }
}

@media (max-width: 767.98px) {
    .mgmt-zoom-result {
        display: none !important;
    }
    .mgmt-zoom-lens {
        display: none !important;
    }
}

.mgmt-thumbnails-wrap {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    overflow-x: auto;
    padding-bottom: 5px;
    scrollbar-width: thin;
    scrollbar-color: var(--mgmt-accent) #f0f0f0;
}

.mgmt-thumbnails-wrap::-webkit-scrollbar {
    height: 4px;
}

.mgmt-thumbnails-wrap::-webkit-scrollbar-track {
    background: #f0f0f0;
}

.mgmt-thumbnails-wrap::-webkit-scrollbar-thumb {
    background-color: var(--mgmt-accent);
    border-radius: 2px;
}

.mgmt-thumbnail-item {
    width: 118px;
    height: 120px;
    flex-shrink: 0;
    cursor: pointer;
    transition: all 0.25s ease;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid lightgray;
}

.mgmt-thumbnail-item img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.mgmt-thumbnail-item:hover,
.mgmt-thumbnail-item.active {
    border-color: var(--mgmt-accent, #6a4914);
}







.detail-docs-flex {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 20px;
}

.detail-doc-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 18px;
    border-radius: 50px;
    text-decoration: none;
    font-size: 15px;
    font-weight: 600;
    transition: all .3s ease;
    border: 1px solid #e5e7eb;
    background: #fff;
}

.detail-doc-pill i {
    font-size: 18px;
}

/* WhatsApp */
.detail-doc-pill.whatsapp {
    color: #25D366;
    border-color: #25D366;
}

.detail-doc-pill.whatsapp:hover {
    background: #25D366;
    color: #fff;
}

/* Phone */
.detail-doc-pill.phone {
    color: #0d6efd;
    border-color: #0d6efd;
}

.detail-doc-pill.phone:hover {
    background: #0d6efd;
    color: #fff;
}

/* Quote */
.detail-doc-pill.quote {
    color: #ff6b00;
    border-color: #ff6b00;
}

.detail-doc-pill.quote:hover {
    background: #ff6b00;
    color: #fff;
}

.pDetaiCtg ul {
    margin: 0;
    padding: 0;
}

.mgmt-detail-meta-line {
    margin: 0;
    padding: 0;
}



@media (max-width: 768px) {
    .detail-doc-pill {
        flex: 1 1 100%;
        justify-content: center;
    }
}




.detail-header-actions{
    position:relative;
}

.share-dropdown{
    position:absolute;
    right:0;
    top:50px;
    width:220px;
    background:#fff;
    border-radius:12px;
    overflow:hidden;
    display:none;
    z-index:999;
    border:1px solid #eee;
}

.share-dropdown a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 16px;
    color:#222;
    text-decoration:none;
    transition:.3s;
}

.share-dropdown a:hover{
    background:#f6f6f6;
    color:#ff6b00;
}

.share-dropdown i{
    width:20px;
    text-align:center;
    font-size:18px;
}

.detail-short-desc p {
    font-size: 14px;
}

.detail-short-desc ul li {
    font-size: 14px;
    list-style: disc;
}

.detail-short-desc ul {
    margin: 0;
    padding-left: 0;
    margin-left: 20px;
}

.ppto {
    display: flex;
    justify-content: space-between;
}

.ppto p {
    margin: 0;
}




/* ==========================================
   PRODUCT CART ACTION - ONE ROW
   ========================================== */

.mgmt-detail-cart-row {
    display: flex;
    align-items: stretch;
    gap: 12px;
    width: 100%;
}

/* Quantity Control */
.mgmt-detail-qty-control {
    display: flex;
    align-items: center;
    height: 35px;
    border: 1px solid #ddd;
    border-radius: 6px;
    overflow: hidden;
    background: #fff;
    flex-shrink: 0;
}

.mgmt-detail-qty-btn {
    width: 45px;
    height: 100%;
    border: 0;
    background: #f5f5f5;
    color: #333;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.mgmt-detail-qty-btn:hover {
    background: #222;
    color: #fff;
}

.mgmt-detail-qty-input {
    width: 38px;
    height: 100%;
    border: 0;
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
    outline: none;
    text-align: center;
    font-size: 16px;
    font-weight: 600;
    background: #fff;
}

/* Remove number input arrows */
.mgmt-detail-qty-input::-webkit-outer-spin-button,
.mgmt-detail-qty-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.mgmt-detail-qty-input {
    -moz-appearance: textfield;
}

/* Add To Cart */
.mgmt-detail-btn-cart {
    min-width: 120px;
    height: 35px;
    border: 1px solid #086766 !important;
    border-radius: 6px;
    background: #086766 !important;
    color: #fff;
    padding: 0 25px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.mgmt-detail-btn-cart:hover {
    background: #fff;
    color: #222;
}

/* Buy Now */
.mgmt-detail-btn-buy {
    min-width: 120px;
    height: 35px;
    border: 0;
    border-radius: 6px;
    background: #053332;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.mgmt-detail-btn-buy:hover {
    background: #c62828;
}


/* ==========================================
   MOBILE
   ========================================== */

@media (max-width: 576px) {

    .mgmt-detail-cart-row {
        gap: 8px;
    }

    .mgmt-detail-qty-control {
        height: 35px;
    }

    .mgmt-detail-qty-btn {
        width: 38px;
    }

    .mgmt-detail-qty-input {
        width: 38px;
    }

    .mgmt-detail-btn-cart {
        height: 35px;
        min-width: 0;
        padding: 0 12px;
        font-size: 14px;
    }

    .mgmt-detail-btn-buy {
        height: 35px;
        font-size: 14px;
    }
}



.mgmt-detail-meta-line b {
    font-weight: 500;
}


.service-feature-box {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.feature-items {
    margin-right: 20px;
    font-size: 14px;
    background: #e7e7e769;
    padding: 4px 10px;
    border-radius: 5px;
}

.feature-items i {
    color: #086766;
    font-size: 14px;
    margin-right: 6px;
}


.pdinfo {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}
.pdinfoList {
    margin-left: 30px;
}


.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #ffffff;
    background-color: #086766;
}




        /* =========================================
           GLOBAL
        ========================================= */


        .qa-review-wrapper {
            width: 100%;
            margin: 20px auto;
        }

        /* =========================================
           SECTION TITLE
        ========================================= */
        .section-title {
            position: relative;
            height: 50px;
            border-bottom: 2px solid #222;
            margin-bottom: 10px;
            display: block;
        }

        .section-title span {
            display: inline-flex;
            align-items: center;
            height: 27px;
            padding: 0 28px 0 10px;
            background: #111;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            position: relative;
            letter-spacing: .2px;
        }

        /* angled right side */
        .section-title span::after {
            content: "";
            position: absolute;
            right: -14px;
            top: 0;
            width: 0;
            height: 0;
            border-top: 27px solid #111;
            border-right: 14px solid transparent;
        }

        /* =========================================
           CUSTOMER QUESTIONS
        ========================================= */
        .sub-heading {
            font-size: 13px;
            font-weight: 700;
            margin: 7px 0 8px;
            color: #222;
        }

        .question-box {
            background: #f7f7f7;
            border: 1px solid #eee;
            padding: 15px 14px;
            margin-bottom: 7px;
        }

        .question-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .qa-label {
            flex: 0 0 18px;
            font-size: 14px;
            color: #333;
        }

        .question-text {
            font-size: 12px;
            line-height: 1.5;
            color: #444;
        }

        .answer-row {
            display: flex;
            gap: 10px;
        }

        .answer-text {
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }

        .answer-text strong {
            font-weight: 700;
        }

        .thank-you {
            margin-top: 8px;
            font-weight: 600;
            font-size: 12px;
        }

        .answered-by {
            margin-top: 10px;
            font-size: 10px;
            color: #444;
        }

        .question-only {
            background: #f7f7f7;
            border: 1px solid #eee;
            padding: 14px;
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        /* =========================================
           ASK QUESTION
        ========================================= */
        .ask-question-box {
            margin-top: 10px;
            display: none;
        }

        .custom-input {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 0;
            padding: 10px 12px;
            font-size: 12px;
            outline: none;
            transition: .2s;
        }

        .custom-input:focus {
            border-color: #aaa;
            box-shadow: none;
        }

        .btn-green {
            background: #5cb85c;
            border: 1px solid #4cae4c;
            color: #fff;
            border-radius: 0;
            padding: 7px 16px;
            font-size: 12px;
        }

        .btn-green:hover {
            background: #449d44;
            color: #fff;
        }

        /* =========================================
           REVIEW SECTION
        ========================================= */
        .review-section {
            margin-top: 8px;
        }

        .no-review {
            margin: 8px 0 18px;
            font-size: 12px;
            color: #555;
        }

        .your-review-title {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        /* =========================================
           STAR RATING
        ========================================= */
        .rating-wrapper {
            margin-bottom: 10px;
        }

        .rating-stars {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .rating-stars i {
            font-size: 15px;
            color: #222;
            cursor: pointer;
            transition: .15s;
        }

        .rating-stars i:hover,
        .rating-stars i.active {
            color: #f5b301;
        }

        .rating-text {
            font-size: 11px;
            color: #777;
            margin-left: 5px;
        }

        /* =========================================
           REVIEW FORM
        ========================================= */
        .review-form {
            border: 1px solid #ddd;
            padding: 3px 12px 12px;
            background: #fff;
        }

        .review-input {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 0;
            padding: 11px 10px;
            font-size: 12px;
            margin-bottom: 12px;
            outline: none;
        }

        .review-input:focus {
            border-color: #aaa;
            box-shadow: none;
        }

        .review-textarea {
            width: 100%;
            min-height: 115px;
            border: 1px solid #ddd;
            resize: vertical;
            border-radius: 0;
            padding: 12px 10px;
            font-size: 12px;
            outline: none;
            margin-bottom: 8px;
        }

        .review-textarea:focus {
            border-color: #aaa;
            box-shadow: none;
        }

        .submit-review {
            background: #5cb85c;
            color: #fff;
            border: 0;
            padding: 7px 12px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .submit-review:hover {
            background: #449d44;
        }

        /* =========================================
           REVIEW ITEM
        ========================================= */
        .review-item {
            background: #f7f7f7;
            border: 1px solid #eee;
            padding: 14px;
            margin-bottom: 8px;
            animation: fadeIn .3s ease;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 7px;
        }

        .review-name {
            font-size: 12px;
            font-weight: 700;
        }

        .review-date {
            font-size: 10px;
            color: #999;
        }

        .review-rating i {
            color: #f5b301;
            font-size: 11px;
        }

        .review-content {
            font-size: 12px;
            color: #555;
            line-height: 1.6;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================================
           SUCCESS MESSAGE
        ========================================= */
        .success-message {
            display: none;
            padding: 8px 10px;
            background: #eaf7ea;
            border: 1px solid #b9dfb9;
            color: #3c763d;
            font-size: 11px;
            margin-top: 10px;
        }

        /* =========================================
           RESPONSIVE
        ========================================= */
        @media (max-width: 576px) {

            .qa-review-wrapper {
                margin: 10px auto;
            }

            .question-box,
            .question-only {
                padding: 12px 10px;
            }

            .review-form {
                padding: 3px 8px 10px;
            }

            .section-title span {
                font-size: 12px;
            }
        }



















</style>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ route('index') }}"
    }
    @foreach($product->productCategories as $index => $ctg),
    {
      "@type": "ListItem",
      "position": {{ $index + 2 }},
      "name": "{{ $ctg->name }}",
      "item": "{{ route('productCategory', $ctg->slug ?: 'no-title') }}"
    }
    @endforeach,
    {
      "@type": "ListItem",
      "position": {{ $product->productCategories->count() + 2 }},
      "name": "{{ $product->name }}",
      "item": "{{ url()->current() }}"
    }
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $product->name }}",
  "image": "{{ assetUrl($product->image()) }}",
  "description": @json(strip_tags($product->seo_contents ?: $product->description)),
  "brand": {
    "@type": "Brand",
    "name": "{{ $product->brand->name ?? 'Unknown' }}"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "BDT",
    "price": "{{ $product->offerPrice() }}",
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/NewCondition"
  }
}
</script>
@endpush

@section('contents')




  <!-- Main Product Detail Page Container -->
  <main class="detail-page-wrapper">
    <div class="container">
      
      <!-- Top Breadcrumb Navigation -->
      <nav aria-label="breadcrumb" class="detail-breadcrumb-card">
        <ol class="detail-breadcrumb-list">
          <li class="detail-breadcrumb-item">
            <a href="{{route('index')}}" class="detail-breadcrumb-link">Home</a>
            <i class="fa-solid fa-chevron-right detail-breadcrumb-separator"></i>
          </li>
          <li class="detail-breadcrumb-item">
            <a href="#" class="detail-breadcrumb-link">Product</a>
            <i class="fa-solid fa-chevron-right detail-breadcrumb-separator"></i>
          </li>
            @foreach($product->productCategories as $ctg)
             <li class="detail-breadcrumb-item active" aria-current="page">
                <a href="{{ route('productCategory', $ctg->slug ?: 'no-title') }}" class="mgmt-detail-meta-link">{{ $ctg->name }}</a>{{ !$loop->last ? ',' : '' }}
            </li>
            @endforeach

        
        </ol>
      </nav>

      <!-- Main Product Details Card -->
      <section class="detail-main-card">
        <div class="row g-4">
          
          <!-- Column 1: Gallery & Media (Left) -->
          <div class="col-12 col-md-5 col-lg-5">
       {{--<div class="detail-media-container">

   
    <div class="detail-main-stage">
        <img src="{{ assetUrl($product->image()) }}"
             alt="{{ $product->name }}"
             class="detail-stage-img"
             id="mainStageImg">

        <button type="button" class="detail-video-btn">
            <i class="fa-solid fa-play"></i> Watch Video
        </button>
    </div>

    @if($product->galleryFiles->count())

        <div class="detail-thumb-strip">

         
            <div class="detail-thumb-box active"
                 onclick="changeMainImage(this, '{{ assetUrl($product->image()) }}')">

                <img src="{{ assetUrl($product->image()) }}"
                     class="detail-thumb-img">

            </div>

            @foreach($product->galleryFiles as $gallery)

                <div class="detail-thumb-box"
                     onclick="changeMainImage(this, '{{ assetUrl($gallery->image()) }}')">

                    <img src="{{ assetUrl($gallery->image()) }}"
                         class="detail-thumb-img">

                </div>

            @endforeach

        </div>

    @endif

</div>--}}


                <div class="mgmt-detail-img-wrap largeImage">
                    <div class="mgmt-detail-img-zoom-wrap">
                        <img src="{{assetUrl($product->image())}}" alt="{{$product->name}}" class="mgmt-detail-img" id="mgmtMainImage">
                        <div class="mgmt-zoom-lens"></div>
                        <div class="mgmt-zoom-result"></div>
                    </div>

                    <div class="mgmt-thumbnails-wrap">
                        <div class="mgmt-thumbnail-item active" data-src="{{assetUrl($product->image())}}">
                            <img src="{{assetUrl($product->image())}}" alt="{{$product->name}}">
                        </div>
                        @if(isset($product->galleryFiles) && $product->galleryFiles->count() > 0)
                            @foreach($product->galleryFiles as $gallery)
                                <div class="mgmt-thumbnail-item" data-src="{{assetUrl($gallery->image())}}">
                                    <img src="{{assetUrl($gallery->image())}}" alt="Gallery Image">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

          </div>

          <!-- Column 2: Product Info & Options (Right) -->
          <div class="col-12 col-md-7 col-lg-7">
            <div class="detail-info-container">
              
              <!-- Title + Code Header -->
              <div class="detail-title-header">
                <div class="detail-title-group">
                  <h1 class="detail-prod-title">{{ $product->name }}</h1>
                  <!--<span class="detail-prod-code">04502</span>-->
                </div>
                <!--<div class="detail-header-actions">-->
                <!--  <button type="button" class="detail-action-icon-btn" title="Share Product">-->
                <!--    <i class="fa-solid fa-share-nodes"></i>-->
                <!--  </button>-->
                <!--  <button type="button" class="detail-action-icon-btn" title="360 View">-->
                <!--    <i class="fa-solid fa-rotate"></i>-->
                <!--  </button>-->
                <!--</div>-->
                
             <div class="detail-header-actions position-relative">
                
                    <button type="button"
                            class="detail-action-icon-btn"
                            id="shareToggle">
                        <i class="fa-solid fa-share-nodes"></i>
                    </button>
                
                    <div class="share-dropdown" id="shareMenu">
                
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                           target="_blank">
                            <i class="fa-brands fa-facebook"></i> Facebook
                        </a>
                
                        <a href="https://wa.me/?text={{ urlencode($product->name.' '.url()->current()) }}"
                           target="_blank">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </a>
                
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($product->name) }}&url={{ urlencode(url()->current()) }}"
                           target="_blank">
                            <i class="fa-brands fa-x-twitter"></i> X
                        </a>
                
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                           target="_blank">
                            <i class="fa-brands fa-linkedin"></i> LinkedIn
                        </a>
                
                        <a href="#" id="copyProductLink">
                            <i class="fa-solid fa-link"></i> Copy Link
                        </a>
                
                    </div>
                
                </div>
                
              </div>
                
                <!--<div class="pDetaiCtg">-->
                <!--    <ul>-->
                <!--        <li>Categories:</li>-->
                <!--         @foreach($product->productCategories as $ctg)-->
                <!--         <li class="detail-breadcrumb-item active" aria-current="page">-->
                <!--            <a href="{{ route('productCategory', $ctg->slug ?: 'no-title') }}" class="mgmt-detail-meta-link">{{ $ctg->name }}</a>{{ !$loop->last ? ',' : '' }}-->
                <!--        </li>-->
                <!--        @endforeach-->
                <!--    </ul>-->
                <!--</div>-->
                
                <div class="ppto">
                    
                    <div>
                         <p class="mgmt-detail-price productPriceAppend">
                            {{priceFullFormat($product->offerPrice())}}/-
                            @if($product->regularPrice() > $product->offerPrice())
                                <del style="font-size: 0.6em; color: #777; margin-left: 10px;">{{priceFullFormat($product->regularPrice())}}/-</del>
                            @endif
                        </p>
                    </div>
                    
                    <div class="pdinfo">
                        
                        <div class="pdinfoList">
                            @if($product->bar_code)
                                <p class="mgmt-detail-meta-line"><b>Model:</b> <span>{{$product->bar_code}}</span></p>
                            @endif
                        </div>
                        
                           <div class="pdinfoList">
                               @if($product->sku_code)
                                <p class="mgmt-detail-meta-line"><b>Product ID:</b> <span>{{$product->sku_code}}</span></p>
                            @endif
                        </div>
                        
                    </div>
                    
                 
                    
                </div>
         
                
                
                       

              
               @if($product->productAttibutesVariationGroup()->count() > 0)
                            <div class="smalOtherBox">
                                @include(welcomeTheme().'products.includes.productVariation')
                            </div>
                        @endif


              


              <!-- Short Details Section -->
              <div class="detail-short-desc">
                <h3 class="detail-short-desc-title">Product Details</h3>
                <p class="detail-short-desc-text">
                  {!!  $product->short_description !!}
                </p>
              </div>

              <!-- All Social Links Sharing Section -->
              
              <div class="row">
                  <div class="col-md-4">
               <div class="detail-social-share-row">
    <ul class="detail-social-icons-list">

        <!-- Facebook -->
        <li>
            <a href="#"
               class="detail-social-icon-btn"
               title="Share on Facebook"
               aria-label="Facebook"
               style="background-color:#1877F2; color:#fff;">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
        </li>

        <!-- YouTube -->
        <li>
            <a href="#"
               class="detail-social-icon-btn"
               title="YouTube"
               aria-label="YouTube"
               style="background-color:#FF0000; color:#fff;">
                <i class="fa-brands fa-youtube"></i>
            </a>
        </li>

        <!-- X / Twitter -->
        <li>
            <a href="#"
               class="detail-social-icon-btn"
               title="Share on X (Twitter)"
               aria-label="X Twitter"
               style="background-color:#000000; color:#fff;">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
        </li>

        <!-- WhatsApp -->
        <li>
            <a href="#"
               class="detail-social-icon-btn"
               title="Share on WhatsApp"
               aria-label="WhatsApp"
               style="background-color:#25D366; color:#fff;">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
        </li>

        <!-- LinkedIn -->
        <li>
            <a href="#"
               class="detail-social-icon-btn"
               title="Share on LinkedIn"
               aria-label="LinkedIn"
               style="background-color:#0A66C2; color:#fff;">
                <i class="fa-brands fa-linkedin-in"></i>
            </a>
        </li>

    </ul>
</div>
                  </div>
                  <div class="col-md-8">
                               
                    <form class="addToCartForm" action="{{route('addToCart',$product->id)}}" method="post">
                        @csrf

                        @if($product->productAttibutesVariationGroup()->count() > 0)
                            <div class="smalOtherBox my-3">
                                @include(welcomeTheme().'products.includes.productVariation')
                            </div>
                        @endif

                    

            

                        <div class="mgmt-detail-cart-row">
                            
                            <div class="mgmt-detail-qty-control quantityValue">
                                <button type="button" class="mgmt-detail-qty-btn decrement-quantity" data-direction="-1" aria-label="Decrease quantity">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" class="mgmt-detail-qty-input productQtyValue" id="qty" value="1" min="1" data-max="{{$product->quantity}}" readonly>
                                <button type="button" class="mgmt-detail-qty-btn increment-quantity" data-direction="1" aria-label="Increase quantity">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            
                               
                             <button type="submit" name="orderNow" value="order" class="mgmt-detail-btn-buy buyNow buyNowSinBtn" data-product-id="{{ $product->id }}">
                            Pre Order
                        </button>
                        
                        <button type="button" class="mgmt-detail-btn-cart addToCart addToSinBtn" data-product-id="{{ $product->id }}" data-url="{{route('addToCart',$product->id)}}">
                                Add to cart
                            </button>
                            
                            
                        </div>

                       
                    </form>
                  </div>
              </div>
              
             
             <div class="service-feature-box mt-2">

            <div class="feature-items">
                <i class="fas fa-check-circle"></i>
                Professional Service
            </div>

            <div class="feature-items">
                <i class="fas fa-clock"></i>
                Quick Response
            </div>

            <div class="feature-items">
                <i class="fas fa-headset"></i>
                24/7 Customer Support
            </div>

        </div>
     

            </div>
          </div>

        </div>
      </section>

      <!-- Full Details Tabbed Section (Description Text Only, Size Chart, Specifications) -->
      <section id="infoDetailsDiv" class="detail-tabs-wrapper">
        <ul class="nav nav-tabs detail-nav-tabs" id="productDetailTabs" role="tablist">
              <li class="nav-item detail-tab-item" role="presentation">
            <button class="nav-link detail-tab-btn active" id="spec-tab" data-bs-toggle="tab" data-bs-target="#spec-tab-pane" type="button" role="tab" aria-controls="spec-tab-pane" aria-selected="false">
              Full Specifications
            </button>
          </li>
          <li class="nav-item detail-tab-item" role="presentation">
            <button class="nav-link detail-tab-btn " id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc-tab-pane" type="button" role="tab" aria-controls="desc-tab-pane" aria-selected="true">
              Full Description
            </button>
          </li>
          
          {{--<li class="nav-item detail-tab-item" role="presentation">
            <button class="nav-link detail-tab-btn" id="size-tab" data-bs-toggle="tab" data-bs-target="#size-tab-pane" type="button" role="tab" aria-controls="size-tab-pane" aria-selected="false">
              Size Chart &amp; Fit Guide
            </button>
          </li>--}}
        
        </ul>

        <div class="tab-content detail-tab-content-box" id="productDetailTabsContent">
            
                     <!-- Tab 3: Full Specifications -->
          <div class="tab-pane fade show active" id="spec-tab-pane" role="tabpanel" aria-labelledby="spec-tab" tabindex="0">
          @if($product->extraAttribute->count() > 0)
    <div class="detail-data-table-wrapper">
        <table class="detail-data-table">
            <tbody>
                @foreach($product->extraAttribute as $extraAttri)
                    <tr>
                        <td class="detail-data-table-label">
                            {!! $extraAttri->name !!}
                        </td>
                        <td>
                            {!! $extraAttri->content !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <span>No Specification Available.</span>
@endif
          </div>
            
          
          <!-- Tab 1: Full Description (Text Only) -->
          <div class="tab-pane fade " id="desc-tab-pane" role="tabpanel" aria-labelledby="desc-tab" tabindex="0">
           {!! $product->description !!}
          </div>

          <!-- Tab 2: Size Chart -->
          <div class="tab-pane fade" id="size-tab-pane" role="tabpanel" aria-labelledby="size-tab" tabindex="0">
            <div class="detail-data-table-wrapper">
              {{--<table class="detail-data-table">
                <thead>
                  <tr>
                    <th>Size</th>
                    <th>Chest Width (cm)</th>
                    <th>Body Length (cm)</th>
                    <th>Sleeve Length (cm)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>S</strong></td>
                    <td>48 cm</td>
                    <td>70 cm</td>
                    <td>20 cm</td>
                  </tr>
                  <tr>
                    <td><strong>M</strong></td>
                    <td>51 cm</td>
                    <td>72 cm</td>
                    <td>21 cm</td>
                  </tr>
                  <tr>
                    <td><strong>L</strong></td>
                    <td>54 cm</td>
                    <td>74 cm</td>
                    <td>22 cm</td>
                  </tr>
                  <tr>
                    <td><strong>XL</strong></td>
                    <td>57 cm</td>
                    <td>76 cm</td>
                    <td>23 cm</td>
                  </tr>
                  <tr>
                    <td><strong>XXL</strong></td>
                    <td>60 cm</td>
                    <td>78 cm</td>
                    <td>24 cm</td>
                  </tr>
                  <tr>
                    <td><strong>3XL</strong></td>
                    <td>63 cm</td>
                    <td>80 cm</td>
                    <td>25 cm</td>
                  </tr>
                  <tr>
                    <td><strong>4XL</strong></td>
                    <td>66 cm</td>
                    <td>82 cm</td>
                    <td>26 cm</td>
                  </tr>
                  <tr>
                    <td><strong>5XL</strong></td>
                    <td>69 cm</td>
                    <td>84 cm</td>
                    <td>27 cm</td>
                  </tr>
                </tbody>
              </table>--}}
               {!! $product->seo_contents !!}
            </div>
          </div>

 

        </div>
      </section>
      
      
      
      
      
      
      
      


    <div class="qa-review-wrapper">

        <!-- =========================================
             QUESTION & ANSWER
        ========================================= -->
        <div class="section-title">
            <span>Question &amp; Answer</span>
        </div>

        <div class="sub-heading">
            Customer Questions
        </div>

        <!-- Question 1 -->
        <div class="question-box">

            <div class="question-row">
                <div class="qa-label">Q:</div>

                <div class="question-text">
                    But material<br>
                    Asked by Visitor
                </div>
            </div>

            <div class="answer-row">
                <div class="qa-label">A:</div>

                <div class="answer-text">

                    <strong>Dear Customer,</strong>

                    <br>

                    100% Viscose Fabric.

                    <br><br>

                    <strong>Thank You.</strong>

                    <div class="answered-by">
                        Answered By: Karam Company Ltd. &nbsp; 21.11.2020
                    </div>

                </div>
            </div>

        </div>

        <!-- Question 2 -->
        <div class="question-only">

            <div class="qa-label">
                Q:
            </div>

            <div class="question-text">
                আপনার পণ্য কেমন ভাবে অর্ডার করবো?
                <br>
                <small>Asked by Visitor</small>
            </div>

        </div>


        <!-- Ask Question Button -->
        <div class="mb-3">
            <button type="button"
                    id="askQuestionBtn"
                    class="btn-green">
                Ask a Question
            </button>
        </div>


        <!-- Ask Question Form -->
        <div class="ask-question-box" id="askQuestionBox">

            <form id="questionForm">

                <div class="mb-2">
                    <input type="text"
                           id="questionName"
                           class="custom-input"
                           placeholder="Name">
                </div>

                <div class="mb-2">
                    <textarea id="questionInput"
                              class="custom-input"
                              rows="4"
                              placeholder="Your Question"></textarea>
                </div>

                <button type="submit" class="btn-green">
                    Submit Question
                </button>

            </form>

        </div>


        <!-- =========================================
             REVIEW
        ========================================= -->
        <div class="review-section">

            <div class="section-title">
                <span>Review</span>
            </div>

            <div class="sub-heading">
                Customer Reviews
            </div>

            <!-- Existing reviews will appear here -->
            <div id="reviewsContainer">

                <div class="no-review" id="noReview">
                    No reviews given yet.
                </div>

            </div>


            <!-- Your Review -->
            <div class="your-review-title">
                Your Review
            </div>


            <!-- Star Rating -->
            <div class="rating-wrapper">

                <div class="rating-stars" id="ratingStars">

                    <i class="fa-regular fa-star" data-rating="1"></i>
                    <i class="fa-regular fa-star" data-rating="2"></i>
                    <i class="fa-regular fa-star" data-rating="3"></i>
                    <i class="fa-regular fa-star" data-rating="4"></i>
                    <i class="fa-regular fa-star" data-rating="5"></i>

                    <span class="rating-text" id="ratingText">
                        Select rating
                    </span>

                </div>

            </div>


            <!-- Review Form -->
            <div class="review-form">

                <form id="reviewForm">

                    <input type="text"
                           id="reviewName"
                           class="review-input"
                           placeholder="Name"
                           required>

                    <textarea id="reviewText"
                              class="review-textarea"
                              placeholder="Review"
                              required></textarea>

                    <button type="submit"
                            class="submit-review">
                        Submit Review
                    </button>

                </form>

                <div class="success-message" id="successMessage">
                    Your review has been submitted successfully.
                </div>

            </div>

        </div>

    </div>



      
      
      
      
      
      

      <!-- Related Products Section (5 cards on PC, 2 cards on Phone) -->
      <section class="detail-related-section">
        <h2 class="detail-related-title">Related Products</h2>
        
        <div class="row g-3 g-md-4">
          
          <!-- Related Card 1 -->
          @foreach($relatedProducts as $product)
          <div class="col-6 col-sm-6 col-md-4 col-lg-2-4">
             @include(welcomeTheme().'products.includes.productCard')
          </div>
          @endforeach


        </div>
      </section>

    </div>
  </main>







@endsection

@push('js')





<script>
$(document).ready(function () {

    /* =========================================
       STAR RATING
    ========================================= */

    let selectedRating = 0;

    $('#ratingStars i').on('mouseenter', function () {

        let rating = $(this).data('rating');

        $('#ratingStars i').each(function () {

            let currentRating = $(this).data('rating');

            if (currentRating <= rating) {

                $(this)
                    .removeClass('fa-regular')
                    .addClass('fa-solid');

            } else {

                $(this)
                    .removeClass('fa-solid')
                    .addClass('fa-regular');

            }

        });

    });


    $('#ratingStars').on('mouseleave', function () {

        updateStars(selectedRating);

    });


    $('#ratingStars i').on('click', function () {

        selectedRating = $(this).data('rating');

        updateStars(selectedRating);

        $('#ratingText').text(
            selectedRating + ' Star' +
            (selectedRating > 1 ? 's' : '')
        );

    });


    function updateStars(rating) {

        $('#ratingStars i').each(function () {

            let currentRating = $(this).data('rating');

            if (currentRating <= rating) {

                $(this)
                    .removeClass('fa-regular')
                    .addClass('fa-solid');

            } else {

                $(this)
                    .removeClass('fa-solid')
                    .addClass('fa-regular');

            }

        });

    }


    /* =========================================
       ASK QUESTION TOGGLE
    ========================================= */

    $('#askQuestionBtn').on('click', function () {

        $('#askQuestionBox').slideToggle(250);

    });


    /* =========================================
       QUESTION SUBMIT
    ========================================= */

    $('#questionForm').on('submit', function (e) {

        e.preventDefault();

        let name = $('#questionName').val().trim();
        let question = $('#questionInput').val().trim();

        if (name === '') {
            alert('Please enter your name.');
            $('#questionName').focus();
            return;
        }

        if (question === '') {
            alert('Please enter your question.');
            $('#questionInput').focus();
            return;
        }


        let questionHtml = `
            <div class="question-only">

                <div class="qa-label">
                    Q:
                </div>

                <div class="question-text">

                    ${escapeHtml(question)}

                    <br>

                    <small>
                        Asked by ${escapeHtml(name)}
                    </small>

                </div>

            </div>
        `;

        $('.question-only').last().after(questionHtml);

        $('#questionName').val('');
        $('#questionInput').val('');

        $('#askQuestionBox').slideUp(250);

        alert('Your question has been submitted.');

    });


    /* =========================================
       REVIEW SUBMIT
    ========================================= */

    $('#reviewForm').on('submit', function (e) {

        e.preventDefault();

        let name = $('#reviewName').val().trim();
        let review = $('#reviewText').val().trim();

        if (selectedRating === 0) {

            alert('Please select a rating.');

            return;
        }

        if (name === '') {

            alert('Please enter your name.');

            $('#reviewName').focus();

            return;
        }

        if (review === '') {

            alert('Please write your review.');

            $('#reviewText').focus();

            return;
        }


        /* Remove "No reviews given yet." */
        $('#noReview').remove();


        /* Generate stars */
        let stars = '';

        for (let i = 1; i <= 5; i++) {

            if (i <= selectedRating) {

                stars += '<i class="fa-solid fa-star"></i>';

            } else {

                stars += '<i class="fa-regular fa-star"></i>';

            }

        }


        /* Get current date */
        let currentDate = new Date();

        let date = currentDate.toLocaleDateString(
            'en-GB',
            {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            }
        );


        /* Create review */
        let reviewHtml = `

            <div class="review-item">

                <div class="review-header">

                    <div>
                        <div class="review-name">
                            ${escapeHtml(name)}
                        </div>

                        <div class="review-rating">
                            ${stars}
                        </div>
                    </div>

                    <div class="review-date">
                        ${date}
                    </div>

                </div>

                <div class="review-content">
                    ${escapeHtml(review)}
                </div>

            </div>

        `;


        $('#reviewsContainer').prepend(reviewHtml);


        /* Reset form */
        $('#reviewName').val('');
        $('#reviewText').val('');

        selectedRating = 0;

        updateStars(0);

        $('#ratingText').text('Select rating');


        /* Success message */
        $('#successMessage')
            .stop(true, true)
            .fadeIn(250)
            .delay(2500)
            .fadeOut(400);

    });


    /* =========================================
       HTML ESCAPE
    ========================================= */

    function escapeHtml(text) {

        return $('<div>')
            .text(text)
            .html();

    }

});
</script>












<script>
$(document).ready(function () {

    $('.color').on('click', function () {

        $('.color').removeClass('active');

        $(this).addClass('active');

        let colorName = $(this).data('color');

        $('#selectedColor').text(colorName);
    });

});
</script>


<script>
function changeMainImage(element, image) {

    document.getElementById('mainStageImg').src = image;

    document.querySelectorAll('.detail-thumb-box').forEach(function(item){
        item.classList.remove('active');
    });

    element.classList.add('active');
}
</script>

<script>


$('#shareProduct').click(function () {

    // HTML ট্যাগ এবং Entities রিমুভ করে নেব
    const productTitle = @json(html_entity_decode(strip_tags($product->name)));
    const productDesc = @json(html_entity_decode(strip_tags($product->product_shortdescription)));
    
    const productUrl = window.location.href;

    if (navigator.share) {
        navigator.share({
            title: productTitle,
            text: productDesc, // এখানে Short Description পাস করা হয়েছে
            url: productUrl
        }).catch((error) => console.log('Share error:', error));
    } else {
        // Facebook Sharer সরাসরি Text নেয় না, তবে URL-এর সাথে Meta tags কাজ করে
        let shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(productUrl);
        window.open(shareUrl, '_blank');
    }

});



$('#shareToggle').click(function (e) {
    e.stopPropagation();
    $('#shareMenu').toggle();
});

$(document).click(function () {
    $('#shareMenu').hide();
});

$('#copyProductLink').click(function (e) {
    e.preventDefault();

    navigator.clipboard.writeText(window.location.href);

    alert('Product link copied successfully!');
});



</script>






<script>
$(document).ready(function(){

    $(document).on('click', '.mgmt-thumbnail-item', function() {
        $('.mgmt-thumbnail-item').removeClass('active');
        $(this).addClass('active');
        var src = $(this).data('src');
        if (src) {
            $('#mgmtMainImage').attr('src', src);
        }
    });

    // Box lens zoom + scroll to change zoom level
    var zoomWrap = $('.mgmt-detail-img-zoom-wrap');
    var zoomLens = $('.mgmt-zoom-lens');
    var zoomResult = $('.mgmt-zoom-result');
    var zoomLevel = 2;
    var minZoom = 2;
    var maxZoom = 6;
    var zoomStep = 0.5;

    zoomWrap.on('mouseenter', function() {
        var src = $(this).find('img').attr('src');
        zoomLens.show();
        zoomResult.show();
        zoomResult.css('background-image', 'url(' + src + ')');
    });

    zoomWrap.on('mousemove', function(e) {
        var $this = $(this);
        var rect = this.getBoundingClientRect();

        var lensW = zoomLens.width() / 2;
        var lensH = zoomLens.height() / 2;

        var x = e.clientX - rect.left - lensW;
        var y = e.clientY - rect.top - lensH;

        x = Math.max(0, Math.min(x, rect.width - zoomLens.width()));
        y = Math.max(0, Math.min(y, rect.height - zoomLens.height()));

        zoomLens.css({ left: x + 'px', top: y + 'px' });

        var px = x / rect.width;
        var py = y / rect.height;

        zoomResult.css({
            backgroundPosition: (px * 100) + '% ' + (py * 100) + '%'
        });
    });

    zoomWrap.on('wheel', function(e) {
        e.preventDefault();
        var delta = e.deltaY || (e.originalEvent && e.originalEvent.deltaY) || 0;
        if (delta < 0) {
            zoomLevel = Math.min(maxZoom, zoomLevel + zoomStep);
        } else {
            zoomLevel = Math.max(minZoom, zoomLevel - zoomStep);
        }
        zoomResult.css('background-size', (zoomLevel * 100) + '%');
    });

    zoomWrap.on('mouseleave', function() {
        zoomLens.hide();
        zoomResult.hide();
    });

    $(".quantityValue .increment-quantity").click(function(){
        var input = $("#qty");
        var max = parseInt(input.attr("data-max")) || 20;
        var value = parseInt(input.val());
        if (value < max) { input.val(value + 1); }
    });

    $(".quantityValue .decrement-quantity").click(function(){
        var input = $("#qty");
        var min = parseInt(input.attr("min")) || 1;
        var value = parseInt(input.val());
        if (value > min) { input.val(value - 1); }
    });

    $(document).on("click", ".addToCart", function () {
    var url = $(this).data("url");
    var quantity = $("#qty").val();

    var option = [];

    $('.attributeValue:checked').each(function () {
        option.push($(this).data('vlueid'));
        // or .val() depending on your HTML
    });

    $.ajax({
        url: url,
        type: "GET",
        data: {
            quantity: quantity,
            option: option
        },
        success: function (data) {

            if (!data.success) {
                alert(data.message);
                return;
            }

            if ($('#offcanvasRight').length) {
                new bootstrap.Offcanvas($('#offcanvasRight')[0]).show();
            }

            $(".shopping-details").html(data.cartViews);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});


$(document).on('click', '.attributeItem li label', function () {

    let $label = $(this);
    let $input = $label.find('.attributeValue');

    // check radio
    $input.prop('checked', true);

    // remove active only in same group (same attribute)
    let groupName = $input.attr('name');

    $('.attributeItem li label').each(function () {
        if ($(this).find('.attributeValue').attr('name') === groupName) {
            $(this).removeClass('active');
        }
    });

    $label.addClass('active');

    // ðŸ”¥ GET SELECTED COLOR / NAME
    let selectedName = $label.data('vari'); // THIS IS IMPORTANT

    // show selected name
    $label.closest('.row')
        .find('.selected-value')
        .text(selectedName);

    // ðŸ”¥ CHANGE MAIN IMAGE IF EXISTS
    // let image = $label.data('image');
    // if (image) {
    //     $('.largeImage img, #mgmtMainImage').attr('src', image);
    // }

    // ðŸ”¥ COLOR FIX (BACKGROUND BOX ALWAYS SHOW)
    if ($label.hasClass('colorItem')) {
        $label.css('background-color', $label.css('background-color'));
    }

});




  $('.attributeItem li label').click(function() {
           
            var dataName = $(this).data('name');
            $('.attributeItem li label[data-name="'+dataName+'"]').removeClass('active');
            
            $(this).addClass('active');
            
            var images = $(this).data('images');
            if (images && images.length > 0) {
                
                $('#mgmtMainImage').attr('src', images[0]);
        
                var $thumbnailWrap = $('.mgmt-thumbnails-wrap');
                $thumbnailWrap.empty();

                $.each(images, function(index, imageUrl) {
                    var activeClass = (index === 0) ? 'active' : '';
                    
                    var thumbHtml = `
                        <div class="mgmt-thumbnail-item ${activeClass}" data-src="${imageUrl}">
                            <img src="${imageUrl}" alt="Gallery Image">
                        </div>
                    `;
                    
                    $thumbnailWrap.append(thumbHtml);
                });
        
            }

            // var image = $(this).data('image');
            // if (image) {
            //     //alert('Image URL: ' + image);
            //     $('.largeImage img').attr('src', image);
            // }
            
            
            setTimeout(function() {
                var selectedIds = [];
                $('.attributeItem li .attributeValue:checked').each(function() {
                    selectedIds.push($(this).data('vlueid'));
                });
                
                var datas = @json($datas);
                
                // var filteredProducts = filterProductsBySelectedAttributes(datas, selectedIds);
                
                // if(filteredProducts.length > 0) {
                //     var priceText = '';
                //     var stutas =true;
                //     var qtyVari =0;
                //     filteredProducts.forEach(function(product) {
                //         priceText += product.price;
                //         stutas =product.stock_status?true:false;
                //         qtyVari =product.quantity;
                //     });
                    
                //     if(stutas){
                        
                //         $('.buyNowSinBtn, .addToSinBtn').prop('disabled', false);
                //         $('.buyNowSinBtn').empty().append('Buy Now');
                //         if($('.productQtyValue').val()==0){
                //             $('.productQtyValue').val(1);
                //             $('.productQtyValue').prop('disabled', false);
                //         }
                        
                //         $('.productQtyValue').attr('data-max',qtyVari);
                //         $('.productPriceAppend').empty().append(priceText);
                //         $('.productStock').empty().append('<b>Stock Available</b>');
                    
                //     }else{
                //         $('.buyNowSinBtn').empty().append('Pre Order');
                //         $('.buyNowSinBtn').prop('disabled', false);
                //         $('.addToSinBtn').prop('disabled', true);
                //         $('.productQtyValue').val(1);
                //         $('.productPriceAppend').empty().append(priceText);
                //         $('.productQtyValue').prop('disabled', false);
                //         $('.productStock').empty().append('<b style="color:red;">Stock Out</b>');
                //     }
                    
                // } else {
                //     $('.buyNowSinBtn, .addToSinBtn').prop('disabled', true);
                //     $('.buyNowSinBtn').empty().append('Buy Now');
                //     $('.productQtyValue').val(0);
                //     $('.productQtyValue').prop('disabled', true);
                //     $('.productStock').empty().append('<b style="color:red;">Stock Out</b>');
                // }
                
                // $('.succeMessage').empty()
                // console.log(filteredProducts);
                // console.log(selectedIds);
                // getPrice();
            }, 10);
            
        });



    $(document).on('click', '.mgmt-accordion-btn', function(){
        var item = $(this).closest('.mgmt-accordion-item');
        var body = item.find('.mgmt-accordion-body');
        var icon = $(this).find('.mgmt-accordion-icon');
        var isOpen = item.hasClass('mgmt-accordion-open');
        item.toggleClass('mgmt-accordion-open', !isOpen);
        body.attr('hidden', isOpen ? 'hidden' : null);
        icon.removeClass('fa-minus fa-plus').addClass(isOpen ? 'fa-plus' : 'fa-minus');
        $(this).attr('aria-expanded', !isOpen);
    });

});
</script>





@endpush
