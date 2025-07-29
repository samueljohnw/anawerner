@extends('template.fullwidth')

@section('title', 'The Discerning of Spirits School | Ana Werner Ministries')

@section('content')
<style>
.landing-page {
    background: linear-gradient(135deg, #133639 0%, #1a4d52 100%);
    color: white;
    min-height: 100vh;
    padding-top: 100px;
}

.hero-section {
    text-align: center;
    padding: 60px 20px;
    background: url('/assets/images/bg-img.png') center/cover;
    position: relative;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(19, 54, 57, 0.8);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.hero-subtitle {
    font-size: 1.8rem;
    margin-bottom: 30px;
    color: #30c0d2;
    font-weight: 600;
}

.hero-description {
    font-size: 1.2rem;
    color:#fff!important;
    line-height: 1.6;
    margin-bottom: 40px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.cta-button {
    display: inline-block;
    background: linear-gradient(45deg, #30c0d2, #26a0b4);
    color: white;
    padding: 18px 40px;
    font-size: 1.3rem;
    font-weight: 700;
    text-decoration: none;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(48, 192, 210, 0.4);
    border: none;
    cursor: pointer;
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(48, 192, 210, 0.6);
    color: white;
}

.content-section {
    padding: 80px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 50px;
    color: #30c0d2;
    text-transform: uppercase;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    margin-bottom: 60px;
}

.feature-card {
    background: rgba(255, 255, 255, 0.1);
    padding: 40px 30px;
    border-radius: 15px;
    text-align: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
}

.feature-icon {
    font-size: 3rem;
    color: #30c0d2;
    margin-bottom: 20px;
}

.feature-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: white;
}

.feature-description {
    line-height: 1.6;
    color: #ffffffff!important;
}

.urgency-section {
    background: linear-gradient(45deg, #30c0d2, #26a0b4);
    padding: 60px 20px;
    text-align: center;
    margin: 80px 0;
}

.urgency-title {
    font-size: 2.8rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-transform: uppercase;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.urgency-text {
    font-size: 1.3rem;
    margin-bottom: 30px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.course-details {
    background: rgba(255, 255, 255, 0.05);
    padding: 60px 40px;
    border-radius: 20px;
    margin: 60px 0;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.detail-item {
    text-align: center;
    padding: 20px;
}

.detail-number {
    font-size: 3rem;
    font-weight: 700;
    color: #30c0d2;
    display: block;
}

.detail-label {
    font-size: 1.1rem;
    margin-top: 10px;
    color: #e0e0e0;
}

.testimonial-section {
    background: rgba(0, 0, 0, 0.2);
    padding: 60px 40px;
    border-radius: 20px;
    text-align: center;
    margin: 60px 0;
}

.testimonial-text {
    font-size: 1.3rem;
    font-style: italic;
    line-height: 1.6;
    margin-bottom: 20px;
    color: #ffffffff!important;
}

.testimonial-author {
    font-size: 1.1rem;
    font-weight: 600;
    color: #30c0d2;
}

.final-cta {
    text-align: center;
    padding: 60px 20px;
    background: linear-gradient(135deg, rgba(48, 192, 210, 0.2), rgba(19, 54, 57, 0.8));
    border-radius: 20px;
    margin-top: 60px;
}

.final-cta-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.final-cta-text {
    font-size: 1.2rem;
    margin-bottom: 30px;
    color: #ffffffff!important;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.4rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .urgency-title {
        font-size: 2.2rem;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="landing-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">The Discerning of Spirits School</h1>
            <h2 class="hero-subtitle">Now is the TIME TO RISE!</h2>
            <p class="hero-description">
                Step into your prophetic calling and learn to discern the spirits with biblical accuracy. 
                This is not a beginner's course - it's designed for those ready to go deeper into the supernatural realm.
            </p>
            <a href="#enroll" class="cta-button">Enroll Now</a>
        </div>
    </section>

    <div class="content-section">
        <!-- Features Section -->
        <h2 class="section-title">What You'll Learn</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">👁️</div>
                <h3 class="feature-title">Spiritual Sight</h3>
                <p class="feature-description">
                    Develop your spiritual eyes to see into the realm of the spirit and discern what is truly happening around you.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⚔️</div>
                <h3 class="feature-title">Warfare Strategies</h3>
                <p class="feature-description">
                    Learn effective spiritual warfare techniques and how to use the gift of discerning of spirits in battle.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📖</div>
                <h3 class="feature-title">Biblical Foundation</h3>
                <p class="feature-description">
                    Ground your understanding in solid biblical principles and learn to test every spirit according to Scripture.
                </p>
            </div>
        </div>

        <!-- Urgency Section -->
        <section class="urgency-section">
            <h2 class="urgency-title">The Time is NOW</h2>
            <p class="urgency-text">
                We are living in the last days and the enemy's deception is increasing. 
                The body of Christ needs those who can discern truth from lies, light from darkness.
            </p>
            <a href="#enroll" class="cta-button">Start Your Journey</a>
        </section>

        <!-- Course Details -->
        <section class="course-details">
            <h2 class="section-title">Course Details</h2>
            <div class="details-grid">
                <div class="detail-item">
                    <span class="detail-number">8</span>
                    <div class="detail-label">Weekly Sessions</div>
                </div>
                <div class="detail-item">
                    <span class="detail-number">LIVE</span>
                    <div class="detail-label">Interactive Q&A</div>
                </div>
                <div class="detail-item">
                    <span class="detail-number">∞</span>
                    <div class="detail-label">Lifetime Access</div>
                </div>
                <div class="detail-item">
                    <span class="detail-number">24/7</span>
                    <div class="detail-label">Replay Available</div>
                </div>
            </div>
        </section>

        <!-- Testimonial -->
        <section class="testimonial-section">
            <p class="testimonial-text">
                "This course completely transformed my understanding of the spiritual realm. 
                I now walk with confidence knowing I can discern what spirit is operating in any situation."
            </p>
            <div class="testimonial-author">- Previous Student</div>
        </section>

        <!-- Final CTA -->
        <section class="final-cta" id="enroll">
            <h2 class="final-cta-title">Ready to Step Into Your Calling?</h2>
            <p class="final-cta-text">
                Join thousands of believers who are operating in the gift of discerning of spirits 
                and making a difference in the Kingdom of God.
            </p>
            <a href="/purchase/price_1QdKO34t1cavPEy4TDuIA8Pw" class="cta-button">Enroll Today - $297</a>
        </div>
    </div>
</div>
@endsection