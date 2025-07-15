CREATE TABLE IF NOT EXISTS users_messages (
    id UUID NOT NULL PRIMARY KEY DEFAULT gen_random_uuid(),
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    message TEXT NOT NULL
);