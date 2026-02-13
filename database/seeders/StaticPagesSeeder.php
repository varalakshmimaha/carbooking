<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class StaticPagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            // Quick Links Pages
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'status' => 'active',
                'meta_title' => 'About Us | Car Booking',
                'meta_description' => 'Learn about Car Booking - your trusted ride partner for safe, comfortable, and reliable journeys across India.',
                'content' => '<h2>About Car Booking</h2>
<p>Welcome to <strong>Car Booking</strong> — your trusted ride partner for safe, comfortable, and reliable journeys. We are dedicated to providing the best cab booking experience across India.</p>

<h3>Our Mission</h3>
<p>Our mission is to make travel easy, affordable, and accessible for everyone. Whether you need a quick city ride, an outstation trip, or an airport transfer, we have you covered with our wide range of vehicles and professional drivers.</p>

<h3>Why Choose Us?</h3>
<ul>
    <li><strong>Safety First:</strong> All our drivers are verified and trained professionals</li>
    <li><strong>24/7 Availability:</strong> Book a ride anytime, anywhere</li>
    <li><strong>Transparent Pricing:</strong> No hidden charges, no surge pricing</li>
    <li><strong>Wide Network:</strong> Available across major cities in India</li>
    <li><strong>Well-Maintained Fleet:</strong> Clean, sanitized, and comfortable vehicles</li>
</ul>

<h3>Our Values</h3>
<p>We believe in putting our customers first. Every ride is an opportunity to earn your trust and exceed your expectations. We are committed to continuous improvement and innovation in the transportation industry.</p>

<h3>Our Team</h3>
<p>Behind Car Booking is a passionate team of professionals working around the clock to ensure your travels are seamless. From our customer support team to our dedicated drivers, everyone at Car Booking shares a common goal — making your journey memorable.</p>',
            ],

            [
                'title' => 'Our Services',
                'slug' => 'services',
                'status' => 'active',
                'meta_title' => 'Our Services | Car Booking',
                'meta_description' => 'Explore our range of cab booking services including one-way trips, round trips, rental packages, and airport transfers.',
                'content' => '<h2>Our Services</h2>
<p>At Car Booking, we offer a comprehensive range of transportation services tailored to meet every travel need.</p>

<h3>🚗 One-Way Trips</h3>
<p>Need to get from point A to point B? Our one-way trip service is perfect for straightforward journeys. Enjoy competitive pricing with no return fare worries.</p>

<h3>🔄 Round Trips</h3>
<p>Planning a trip with a return? Our round-trip service offers the best rates for two-way journeys. The driver stays with you throughout, ensuring a hassle-free experience.</p>

<h3>🕐 Rental Packages</h3>
<p>Need a car for a few hours? Choose from our flexible rental packages — 4-hour, 8-hour, and 12-hour options available. Perfect for local sightseeing, meetings, or running errands.</p>

<h3>✈️ Airport Transfers</h3>
<p>Start or end your journey stress-free with our reliable airport transfer service. Punctual pickups, flight tracking, and comfortable rides to and from all major airports.</p>

<h3>🏢 Corporate Travel</h3>
<p>We offer customized travel solutions for businesses. From employee transportation to client pickups, our corporate packages are designed to save you time and money.</p>

<h3>🎉 Special Occasions</h3>
<p>Make your special events extra special with our premium vehicle options. Weddings, anniversaries, or VIP events — we have the perfect ride for every occasion.</p>',
            ],

            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'status' => 'active',
                'meta_title' => 'Contact Us | Car Booking',
                'meta_description' => 'Get in touch with Car Booking. We are here to help with your ride booking queries, feedback, and support.',
                'content' => '<h2>Contact Us</h2>
<p>We would love to hear from you! Whether you have a question about our services, pricing, or anything else, our team is ready to answer all your questions.</p>

<h3>📍 Our Office</h3>
<p><strong>Raitha Okkuta</strong><br>
Near Taluk Office, Main Road,<br>
Narasimharajpur - 577134</p>

<h3>📞 Phone</h3>
<p><strong>Customer Support:</strong> +91 9342361210<br>
<em>Available 24/7</em></p>

<h3>📧 Email</h3>
<p><strong>General Inquiries:</strong> raitha.okkuta@gmail.com</p>

<h3>💬 Feedback</h3>
<p>Your feedback is valuable to us! If you had a great experience or have suggestions for improvement, please do not hesitate to reach out. We constantly strive to enhance our services based on your inputs.</p>',
            ],

            // Legal Policy Pages
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'status' => 'active',
                'meta_title' => 'Privacy Policy | Car Booking',
                'meta_description' => 'Read our privacy policy to understand how Car Booking collects, uses, and protects your personal information.',
                'content' => '<h2>Privacy Policy</h2>
<p><em>Last updated: February 2026</em></p>

<p>At Car Booking, we take your privacy seriously. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our services.</p>

<h3>1. Information We Collect</h3>
<p>We may collect personal information that you voluntarily provide to us, including:</p>
<ul>
    <li>Name, email address, and phone number</li>
    <li>Pickup and drop-off locations</li>
    <li>Payment information</li>
    <li>Device and usage information</li>
</ul>

<h3>2. How We Use Your Information</h3>
<p>We use the information we collect to:</p>
<ul>
    <li>Process and manage your ride bookings</li>
    <li>Communicate with you about your rides</li>
    <li>Improve our services and user experience</li>
    <li>Send promotional offers and updates (with your consent)</li>
    <li>Ensure safety and security of our platform</li>
</ul>

<h3>3. Information Sharing</h3>
<p>We do not sell your personal information. We may share your data with:</p>
<ul>
    <li>Drivers assigned to your rides (only necessary details)</li>
    <li>Payment processors for transaction handling</li>
    <li>Service providers who assist our operations</li>
    <li>Law enforcement, when required by law</li>
</ul>

<h3>4. Data Security</h3>
<p>We implement industry-standard security measures to protect your personal information, including encryption, secure servers, and regular security audits.</p>

<h3>5. Your Rights</h3>
<p>You have the right to access, update, or delete your personal data. Contact us at <strong>support@carbooking.com</strong> for any privacy-related requests.</p>

<h3>6. Contact Us</h3>
<p>If you have questions about this Privacy Policy, please contact us at <strong>info@carbooking.com</strong>.</p>',
            ],

            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'status' => 'active',
                'meta_title' => 'Terms & Conditions | Car Booking',
                'meta_description' => 'Read the terms and conditions for using Car Booking services. Understand your rights and responsibilities as a user.',
                'content' => '<h2>Terms & Conditions</h2>
<p><em>Last updated: February 2026</em></p>

<p>Welcome to Car Booking. By using our services, you agree to comply with and be bound by the following terms and conditions.</p>

<h3>1. Acceptance of Terms</h3>
<p>By accessing or using our platform and services, you agree to be bound by these Terms & Conditions. If you do not agree, please do not use our services.</p>

<h3>2. Booking & Payment</h3>
<ul>
    <li>All bookings are subject to availability of vehicles and drivers</li>
    <li>Fare estimates are approximate and may vary based on actual distance and time</li>
    <li>Payment is required at the time of booking or upon completion of the ride</li>
    <li>We accept online payments, UPI, and cash (where applicable)</li>
</ul>

<h3>3. User Responsibilities</h3>
<ul>
    <li>Provide accurate booking information</li>
    <li>Be available at the pickup location at the scheduled time</li>
    <li>Treat drivers and vehicles with respect</li>
    <li>Do not carry illegal or prohibited items</li>
</ul>

<h3>4. Cancellation</h3>
<p>Cancellation charges may apply based on the timing of cancellation. Please refer to our <a href="/cancellation-policy">Cancellation Policy</a> for details.</p>

<h3>5. Limitation of Liability</h3>
<p>Car Booking shall not be liable for any indirect, incidental, or consequential damages arising from the use of our services. Our total liability shall not exceed the amount paid for the specific ride in question.</p>

<h3>6. Changes to Terms</h3>
<p>We reserve the right to modify these terms at any time. Continued use of our services after changes constitutes acceptance of the updated terms.</p>

<h3>7. Contact</h3>
<p>For questions about these Terms & Conditions, please contact us at <strong>info@carbooking.com</strong>.</p>',
            ],

            [
                'title' => 'Refund Policy',
                'slug' => 'refund-policy',
                'status' => 'active',
                'meta_title' => 'Refund Policy | Car Booking',
                'meta_description' => 'Understand our refund policy for cancelled rides, overcharges, and service issues at Car Booking.',
                'content' => '<h2>Refund Policy</h2>
<p><em>Last updated: February 2026</em></p>

<p>At Car Booking, we strive to provide the best service. If something goes wrong, our refund policy is designed to be fair and transparent.</p>

<h3>1. Eligible Refund Scenarios</h3>
<ul>
    <li><strong>Driver no-show:</strong> Full refund if the driver does not arrive within 30 minutes of the scheduled time</li>
    <li><strong>Overcharging:</strong> Difference amount refunded if fare exceeds the quoted estimate by more than 10%</li>
    <li><strong>Service issues:</strong> Partial or full refund for significant service quality issues</li>
    <li><strong>Double payment:</strong> Full refund for any duplicate charges</li>
</ul>

<h3>2. Refund Process</h3>
<ul>
    <li>Raise a refund request within 48 hours of the ride completion</li>
    <li>Provide booking details and reason for the refund</li>
    <li>Our team will review and respond within 3-5 business days</li>
    <li>Approved refunds are processed within 7-10 business days</li>
</ul>

<h3>3. Refund Methods</h3>
<p>Refunds will be credited to the original payment method:</p>
<ul>
    <li><strong>Online payments:</strong> Refunded to the same card/account</li>
    <li><strong>UPI payments:</strong> Refunded to the same UPI ID</li>
    <li><strong>Cash payments:</strong> Credited to your Car Booking wallet</li>
</ul>

<h3>4. Non-Refundable Scenarios</h3>
<ul>
    <li>Ride completed as per booking details</li>
    <li>Cancellation after the driver has arrived</li>
    <li>No-show by the passenger</li>
</ul>

<h3>5. Contact</h3>
<p>For refund requests, please email <strong>support@carbooking.com</strong> with your booking details.</p>',
            ],

            [
                'title' => 'Cancellation Policy',
                'slug' => 'cancellation-policy',
                'status' => 'active',
                'meta_title' => 'Cancellation Policy | Car Booking',
                'meta_description' => 'Learn about our cancellation policy including fees, time windows, and the process for cancelling a ride.',
                'content' => '<h2>Cancellation Policy</h2>
<p><em>Last updated: February 2026</em></p>

<p>We understand that plans can change. Here is our cancellation policy to help you understand the charges and process involved.</p>

<h3>1. Free Cancellation Window</h3>
<ul>
    <li><strong>Instant bookings:</strong> Free cancellation within 5 minutes of booking</li>
    <li><strong>Scheduled bookings:</strong> Free cancellation up to 2 hours before the scheduled pickup time</li>
</ul>

<h3>2. Cancellation Charges</h3>
<ul>
    <li><strong>After free window but 1+ hour before pickup:</strong> ₹50 cancellation fee</li>
    <li><strong>Within 1 hour of pickup:</strong> ₹100 cancellation fee</li>
    <li><strong>After driver arrival:</strong> ₹150 cancellation fee + waiting charges</li>
    <li><strong>No-show (15 min after scheduled time):</strong> ₹200 fee</li>
</ul>

<h3>3. How to Cancel</h3>
<p>You can cancel your booking through:</p>
<ul>
    <li>Your booking confirmation page</li>
    <li>Calling our support helpline at +91 98765 43210</li>
    <li>Emailing <strong>support@carbooking.com</strong></li>
</ul>

<h3>4. Cancellation by Driver/Car Booking</h3>
<p>In rare cases where we need to cancel your booking due to unavailability or unforeseen circumstances:</p>
<ul>
    <li>You will receive a full refund</li>
    <li>We will try to arrange an alternative ride</li>
    <li>You will receive a discount coupon for your next ride</li>
</ul>

<h3>5. Contact</h3>
<p>For any cancellation-related queries, please contact us at <strong>support@carbooking.com</strong> or call +91 98765 43210.</p>',
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }

        $this->command->info('Static pages seeded successfully!');
    }
}
