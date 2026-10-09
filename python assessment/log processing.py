def count_errors(file_path):
    error_count = 0

    try:
        with open(file_path, "r", encoding="utf-8", errors="replace") as file:
            for line in file:
                error_count += line.count("ERROR")

        print(f"Total occurrences of ERROR: {error_count}")

    except FileNotFoundError:
        print("Error: Log file not found. Please check the file path.")

    except PermissionError:
        print("Error: Permission denied. Cannot read the log file.")

    except OSError as error:
        print(f"Error reading log file: {error}")


file_path = input("Enter the log file path: ").strip()
count_errors(file_path)