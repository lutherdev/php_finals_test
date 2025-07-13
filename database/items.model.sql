CREATE TABLE IF NOT EXISTS items (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    quantity INTEGER DEFAULT 0,
    price NUMERIC(10, 2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    img_path VARCHAR(100) NOT NULL,
    status VARCHAR(50) DEFAULT 'is-active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);