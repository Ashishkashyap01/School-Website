<?php

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

?>

<!-- PAGE BANNER -->

<section class="page-banner">

    <div class="page-banner-overlay"></div>

    <img src="srs/assets/images/contact/banner.jpg" alt="Contact Banner">

    <div class="container page-banner-content">

        <h1>Contact Us</h1>

        <p>Home / Contact</p>

    </div>

</section>

<!-- CONTACT INFO -->

<section class="contact-section">

<div class="container">

<div class="section-title">

<span class="section-tag">

GET IN TOUCH

</span>

<h2>

We'd Love To Hear From You

</h2>

<p>

Feel free to contact us for admission enquiries.

</p>

</div>

<div class="contact-grid">

<div class="contact-info">

<div class="info-card">

<h3>📍 Address</h3>

<p>

Sone Rising School<br>

Veer Kuwar Singh chowk New Dilliya <br>
Dehri On Sone Rohtas Bihar 821307
</p>

</div>

<div class="info-card">

<h3>☎ Phone</h3>

<p>

+91-9308002335, 06184 359332
</p>
<br>

<a
href="https://wa.me/919308002335?text=Hello%20Sone%20Rising%20School,%0A%0AI%20would%20like%20to%20enquire%20about%20admission.%0A%0AThank%20you."
target="_blank"
class="whatsapp-btn">

<i class="fa-brands fa-whatsapp"></i>

Chat on WhatsApp

</a>
</div>

<div class="info-card">

<h3>✉ Email</h3>

<p>

prashant0087@gmail.com<br>
srsdehri2011@sonerisingschool.com


</p>

</div>

<div class="info-card">

<h3>🕒 Office Hours</h3>

<p>

Monday - Saturday

8:00 AM - 3:00 PM

</p>

</div>

</div>

<!-- CONTACT FORM -->

<div class="contact-form">

<form
id="contactForm"
action="/srs/ajax/contact-save.php"
method="POST">

<input
type="text"
name="name"
placeholder="Full Name"
required>

<input
type="tel"
name="phone"
placeholder="Phone Number"
required>

<input
type="email"
name="email"
placeholder="Email Address">

<select
name="subject"
required>

<option value="">Select Subject</option>

<option value="Admission Enquiry">
Admission Enquiry
</option>

<option value="Fee Structure">
Fee Structure
</option>

<option value="Transport">
Transport
</option>

<option value="Academics">
Academics
</option>

<option value="General Enquiry">
General Enquiry
</option>

<option value="Complaint">
Complaint
</option>

<option value="Other">
Other
</option>

</select>

<select name="class">

<option value="">Select Class</option>

<option>Nursery</option>

<option>LKG</option>

<option>UKG</option>

<option>Class I</option>

<option>Class II</option>

<option>Class III</option>

<option>Class IV</option>

<option>Class V</option>

<option>Class VI</option>

<option>Class VII</option>

<option>Class VIII</option>

<option>Class IX</option>

<!------<option>Class X</option>

<option>Class XI</option>

<option>Class XII</option>------------------->

</select>

<select name="contact_method">

<option value="">

Preferred Contact Method

</option>

<option value="Phone">

Phone

</option>

<option value="WhatsApp">

WhatsApp

</option>

<option value="Email">

Email

</option>

</select>

<textarea
name="message"
rows="6"
placeholder="Your Message"
required></textarea>

<button
id="contactSubmit"
class="btn-primary"
type="submit">

Send Enquiry

</button>

</form>

</div>

</div>

</div>

</section>

<!-- MAP -->

<section class="map-section">

<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3274.6989834801398!2d84.16795349121094!3d24.909570693969727!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398daec09b17ce25%3A0xc72d6de06bb46a57!2sSone%20Rising%20School!5e1!3m2!1sen!2sin!4v1785561771122!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>

</section>

<!-- CTA -->

<section class="cta-section">

<div class="container cta-box">

<div>

<span class="section-tag">

ADMISSION OPEN

</span>

<h2>

Join Sone Rising School Today

</h2>

<p>

Limited seats available for Session 2026-27

</p>

</div>

<div>

<a

href="srs/admission"

class="btn-primary">

Apply Now

</a>

</div>

</div>

</section>

<?php

require_once __DIR__.'/../includes/footer.php';

?>