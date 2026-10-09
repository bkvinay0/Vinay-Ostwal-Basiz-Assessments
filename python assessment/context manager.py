from contextlib import contextmanager


@contextmanager
def database_connection():
    print("Connecting to database...")
    print("Database connected successfully.")

    try:
        yield
    finally:
        print("Closing database connection...")
        print("Database connection closed.")


try:
    with database_connection():
        print("Performing database operation...")
        print("Database operation completed successfully.")

except Exception as error:
    print(f"Error: {error}")