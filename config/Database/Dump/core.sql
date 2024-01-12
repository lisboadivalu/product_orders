-- DROP DATABASE softexpert;
CREATE DATABASE softexpert;

\c softexpert;

CREATE TABLE public.categories(
    id SERIAL PRIMARY KEY,
    title VARCHAR(100) not null,
    tax_percentage int not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT NULL
);

CREATE TABLE public.products(
    id SERIAL PRIMARY KEY,
    category_id BIGINT NOT NULL,
    title VARCHAR(100) NOT NULL,
    price NUMERIC(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT NULL,
        CONSTRAINT fk_category_id
            FOREIGN KEY (category_id)
                REFERENCES categories (id)
                    ON DELETE CASCADE
);

CREATE TABLE public.orders(
  id SERIAL PRIMARY KEY,
  category_id BIGINT NOT NULL,
  product_id  BIGINT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT NULL,
  CONSTRAINT fk_category_id
      FOREIGN KEY (category_id)
        REFERENCES categories (id)
            ON DELETE CASCADE,
  CONSTRAINT fk_product_id
      FOREIGN KEY (product_id)
        REFERENCES products (id)
            ON DELETE CASCADE
);