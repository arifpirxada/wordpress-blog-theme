<style>
    .collection-container {
        margin: 60px 0;
    }

    .collection-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .collection-container .collection-header h2 {
        font-size: 2.5rem;
        color: #2c3e50;
        margin-bottom: 10px;
        font-weight: 300;
    }

    .collection-container .collection-header p {
        color: #7f8c8d;
        font-size: 1.1rem;
    }

    .collection-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .collection-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
    }

    .collection-grid .collection-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }

    .collection-card .bestseller-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #e74c3c;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
    }

    .collection-card .fragrance-notes {
        position: absolute;
        top: 20px;
        right: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        z-index: 2;
    }

    .collection-card .fragrance-notes .note-icon {
        background: rgba(255, 255, 255, 0.9);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        color: #7f8c8d;
        backdrop-filter: blur(10px);
    }

    .collection-card .product-image {
        height: 300px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .collection-card .product-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1.5" fill="rgba(255,255,255,0.1)"/></svg>');
    }

    .collection-card .product-image .bottle {
        width: 120px;
        height: 180px;
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1));
        border-radius: 10px 10px 30px 30px;
        position: relative;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .collection-card .product-image .bottle::before {
        content: '';
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 25px;
        background: rgba(0, 0, 0, 0.8);
        border-radius: 5px 5px 0 0;
    }

    .collection-card .product-image .bottle::after {
        content: '';
        position: absolute;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .collection-card .product-info {
        padding: 30px;
    }

    .collection-card .product-info .product-title {
        font-size: 1.3rem;
        color: #2c3e50;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .collection-card .product-info .product-subtitle {
        color: #7f8c8d;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .collection-card .product-info .rating {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .collection-card .product-info .rating .stars {
        color: #f39c12;
        font-size: 1.1rem;
    }

    .collection-card .product-info .rating .rating-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .collection-card .product-info .rating .rating-info .rating-score {
        font-weight: 600;
        color: #2c3e50;
    }

    .collection-card .product-info .price {
        font-size: 1.2rem;
        font-weight: 600;
        color: #e74c3c;
    }

    .collection-card .product-info .scent-indicators {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }

    .collection-card .product-info .scent-indicators .scent-tag {
        background: #ecf0f1;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        color: #7f8c8d;
    }

    .collection-container .collection-card.card-1 .product-image {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .collection-container .collection-card.card-2 .product-image {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .collection-container .collection-card.card-3 .product-image {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .collection-container .collection-card.card-4 .product-image {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    @media (max-width: 768px) {
        .collection-container .collection-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .collection-container .collection-header h2 {
            font-size: 2rem;
        }
    }
</style>

<div class="collection-container">
<div class="collection-container">
    <div class="collection-header">
        <h2>Editor's Picks</h2>
        <p>Curated blog posts from our writers — trending topics, timeless reads, and hidden gems.</p>
    </div>

    <div class="collection-grid">
        <div class="collection-card card-1">
            <div class="bestseller-badge">FEATURED</div>
            <div class="fragrance-notes">
                <div class="note-icon">🧠</div>
                <div class="note-icon">📖</div>
                <div class="note-icon">🌿</div>
            </div>
            <div class="product-image">
                <div class="bottle"></div>
            </div>
            <div class="product-info">
                <h3 class="product-title">The Psychology of Simplicity</h3>
                <p class="product-subtitle">Minimalism & Mindfulness</p>
                <div class="rating">
                    <div class="stars">★★★★☆</div>
                    <div class="rating-info">
                        <span class="rating-score">4.4</span>
                        <span>|</span>
                        <span>📝 (38 comments)</span>
                    </div>
                </div>
                <div class="price">5 min read</div>
                <div class="scent-indicators">
                    <div class="scent-tag">Lifestyle</div>
                    <div class="scent-tag">Wellness</div>
                    <div class="scent-tag">Mind</div>
                </div>
            </div>
        </div>

        <div class="collection-card card-2">
            <div class="bestseller-badge">POPULAR</div>
            <div class="fragrance-notes">
                <div class="note-icon">🌍</div>
                <div class="note-icon">📷</div>
                <div class="note-icon">✈️</div>
            </div>
            <div class="product-image">
                <div class="bottle"></div>
            </div>
            <div class="product-info">
                <h3 class="product-title">A Guide to Solo Travel</h3>
                <p class="product-subtitle">Journeys of Discovery</p>
                <div class="rating">
                    <div class="stars">★★★★☆</div>
                    <div class="rating-info">
                        <span class="rating-score">4.4</span>
                        <span>|</span>
                        <span>📝 (47 comments)</span>
                    </div>
                </div>
                <div class="price">7 min read</div>
                <div class="scent-indicators">
                    <div class="scent-tag">Travel</div>
                    <div class="scent-tag">Adventure</div>
                    <div class="scent-tag">Solo</div>
                </div>
            </div>
        </div>

        <div class="collection-card card-3">
            <div class="bestseller-badge">RECOMMENDED</div>
            <div class="fragrance-notes">
                <div class="note-icon">🌼</div>
                <div class="note-icon">📔</div>
                <div class="note-icon">💬</div>
            </div>
            <div class="product-image">
                <div class="bottle"></div>
            </div>
            <div class="product-info">
                <h3 class="product-title">Finding Your Creative Voice</h3>
                <p class="product-subtitle">From Hobby to Habit</p>
                <div class="rating">
                    <div class="stars">★★★★★</div>
                    <div class="rating-info">
                        <span class="rating-score">4.7</span>
                        <span>|</span>
                        <span>📝 (21 comments)</span>
                    </div>
                </div>
                <div class="price">6 min read</div>
                <div class="scent-indicators">
                    <div class="scent-tag">Creativity</div>
                    <div class="scent-tag">Writing</div>
                    <div class="scent-tag">Motivation</div>
                </div>
            </div>
        </div>

        <div class="collection-card card-4">
            <div class="bestseller-badge">TRENDING</div>
            <div class="fragrance-notes">
                <div class="note-icon">💡</div>
                <div class="note-icon">📱</div>
                <div class="note-icon">⌛</div>
            </div>
            <div class="product-image">
                <div class="bottle"></div>
            </div>
            <div class="product-info">
                <h3 class="product-title">Digital Declutter in 2025</h3>
                <p class="product-subtitle">Reclaiming Your Time</p>
                <div class="rating">
                    <div class="stars">★★★★★</div>
                    <div class="rating-info">
                        <span class="rating-score">4.6</span>
                        <span>|</span>
                        <span>📝 (41 comments)</span>
                    </div>
                </div>
                <div class="price">4 min read</div>
                <div class="scent-indicators">
                    <div class="scent-tag">Tech</div>
                    <div class="scent-tag">Productivity</div>
                    <div class="scent-tag">Focus</div>
                </div>
            </div>
        </div>
    </div>
</div>
