<?php

require_once __DIR__.'/../includes/header.php';
require_once __DIR__.'/../includes/navbar.php';

?>

<!-- PAGE BANNER -->

<section class="page-banner">

    <div class="page-banner-overlay"></div>

    <img src="/srs/assets/images/admission/banner.jpg" alt="Admission">

    <div class="container page-banner-content">

        <h1>Admissions Open</h1>

        <p>Home / Admission</p>

    </div>

</section>

<!-- INTRO -->

<section class="admission-intro">

    <div class="container admission-grid">

        <div>

            <img src="/srs/assets/images/admission/adm.png" alt="Admission">

        </div>

        <div>

            <span class="section-tag">

                ADMISSION 2026-27

            </span>

            <h2>

                Join The Sone Rising School Family

            </h2>

            <p>

                Admissions are open from Nursery to Class XII.
                We focus on academic excellence, discipline,
                innovation and holistic development.

            </p>

            <a href="#admissionForm"

               class="btn-primary">

               Apply Online

            </a>

        </div>

    </div>

</section>

<!-- PROCESS -->

<section class="process-section">

<div class="container">

<div class="section-title">

<span class="section-tag">

ADMISSION PROCESS

</span>

<h2>

Simple 5 Step Process

</h2>

</div>

<div class="process-grid">

<div class="process-card">

<h3>1</h3>

<p>Enquiry</p>

</div>

<div class="process-card">

<h3>2</h3>

<p>Campus Visit</p>

</div>

<div class="process-card">

<h3>3</h3>

<p>Registration</p>

</div>

<div class="process-card">

<h3>4</h3>

<p>Document Verification</p>

</div>

<div class="process-card">

<h3>5</h3>

<p>Admission Confirmation</p>

</div>

</div>

</div>

</section>

<!-- DOCUMENTS -->

<section class="documents-section">

<div class="container">

<div class="section-title">

<span class="section-tag">

DOCUMENTS

</span>

<h2>

Required Documents

</h2>

</div>

<ul class="document-list">

<li>Birth Certificate</li>

<li>Aadhar Card</li>

<li>Passport Size Photographs</li>

<li>Transfer Certificate (If Applicable)</li>

<li>Previous Report Card</li>

</ul>

</div>

</section>

<!-- CTA -->

<section class="cta-section">

<div class="container cta-box">

<div>

<span class="section-tag">

START TODAY

</span>

<h2>

Admissions Are Open

</h2>

<p>

Limited seats available.

</p>

</div>

<div>

<a href="#admissionForm"

class="btn-primary">

Apply Now

</a>

</div>

</div>

</section>
<!-- ==========================
ADMISSION ENQUIRY
========================== -->

<section class="admission-enquiry-section" id="admissionForm">

<div class="container">

<div class="section-title">

<span class="section-tag">

ADMISSION ENQUIRY

</span>

<h2>

Apply For Admission

</h2>

<p>

Fill out the enquiry form below and our admission team will contact you shortly.

</p>

</div>

<div class="admission-form-wrapper">

<form
id="admissionFormElement"
action="/srs/ajax/admission-save.php"
method="POST">

<div class="form-grid">

<div class="form-group">

<label>

Student Name *

</label>

<input
type="text"
name="student_name"
required>

</div>

<div class="form-group">

<label>

Parent Name *

</label>

<input
type="text"
name="parent_name"
required>

</div>

<div class="form-group">

<label>

Mobile Number *

</label>

<input
type="text"
name="phone"
required>

</div>

<div class="form-group">

<label>

Email

</label>

<input
type="email"
name="email">

</div>

<div class="form-group">

<label>

Applying For Class *

</label>

<select
name="applying_class"
required>

<option value="">

Select Class

</option>

<option>

Nursery

</option>

<option>

LKG

</option>

<option>

UKG

</option>

<?php for($i=1;$i<=12;$i++): ?>

<option>

Class <?= $i; ?>

</option>

<?php endfor; ?>

</select>

</div>

<div class="form-group full-width">

<label>

Message

</label>

<textarea
name="message"
rows="5"
placeholder="Write your message here..."></textarea>

</div>

</div>

<div class="form-submit">

<button
type="submit"
class="btn-primary"
id="admissionSubmit">

📩 Submit Admission Enquiry

</button>

<button
type="button"
id="whatsappBtn"
class="btn-whatsapp">

<i class="fab fa-whatsapp"></i>

Send on WhatsApp

</button>

</div>

</form>

</div>

</div>

</section>

<?php

require_once __DIR__.'/../includes/footer.php';

?>