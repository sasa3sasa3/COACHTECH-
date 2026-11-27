```mermaid
erDiagram
    categories ||--o{ contacts : 分類する
    tags ||--o{ contact_tag : タグ付け
    contacts ||--o{ contact_tag : タグ付け
    users
    
users {
    bigint id PK
    string name
    string email "UNIQUE"
    timestamp email_verified_at "NULL許可"
    string password
    string remember_token "NULL許可"
    timestamp created_at
    timestamp updated_at
}

categories{
    bigint id PK
    string content
    timestamp created_at
    timestamp updated_at
}

tags{
    bigint id PK
    string name "UNIQUE"
    timestamp created_at
    timestamp updated_at
}

contacts{
    bigint id PK
    bigint category_id FK
    string first_name
    string last_name
    tinyint gender
    string email
    string tel
    string address
    string building "NULL許可"
    string detail
    timestamp created_at
    timestamp updated_at
}

contact_tag{
    bigint id PK
    bigint contact_id FK
    bigint tag_id FK
    timestamp created_at
    timestamp updated_at
}