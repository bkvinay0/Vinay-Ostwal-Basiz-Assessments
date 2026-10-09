def calculator():
    print("Simple Calculator")
    print("1. Addition (+)")
    print("2. Subtraction (-)")
    print("3. Multiplication (*)")
    print("4. Division (/)")

    try:
        first_number = float(input("Enter first number: "))
        operator = input("Enter operator (+, -, *, /): ").strip()
        second_number = float(input("Enter second number: "))

        if operator == "+":
            result = first_number + second_number
        elif operator == "-":
            result = first_number - second_number
        elif operator == "*":
            result = first_number * second_number
        elif operator == "/":
            if second_number == 0:
                print("Error: Cannot divide by zero.")
                return
            result = first_number / second_number
        else:
            print("Error: Please enter a valid operator.")
            return

        print("Result:", result)

    except ValueError:
        print("Error: Please enter valid numbers.")


calculator()