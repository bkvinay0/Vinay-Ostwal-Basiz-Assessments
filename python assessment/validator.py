class EmailValidator:
    def validate(self, value):
        return (
            "@" in value
            and "." in value.split("@")[-1]
            and " " not in value
        )


class PasswordValidator:
    def validate(self, value):
        return (
            len(value) >= 8
            and any(char.isupper() for char in value)
            and any(char.islower() for char in value)
            and any(char.isdigit() for char in value)
            and any(not char.isalnum() for char in value)
        )


class Validator:
    def __init__(self, strategy):
        self.strategy = strategy

    def set_strategy(self, strategy):
        self.strategy = strategy

    def validate(self, value):
        return self.strategy.validate(value)


validator = Validator(EmailValidator())

while True:
    email = input("Enter your email address: ").strip()

    if not email:
        print("Error: Email address cannot be empty.")
    elif validator.validate(email):
        print("Success: Email address accepted.")
        break
    else:
        print("Error: Please enter a valid email address.")


validator.set_strategy(PasswordValidator())

while True:
    password = input("Enter your password: ")

    if not password:
        print("Error: Password cannot be empty.")
    elif validator.validate(password):
        print("Success: Password meets all requirements.")
        break
    else:
        print(
            "Error: Password must contain at least 8 characters, "
            "one uppercase letter, one lowercase letter, "
            "one number, and one special character."
        )