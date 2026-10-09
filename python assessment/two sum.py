def two_sum(numbers, target):
    seen = {}

    for index, number in enumerate(numbers):
        required = target - number

        if required in seen:
            return [seen[required], index]

        seen[number] = index

    return []


numbers = list(map(int, input("Enter numbers separated by commas: ").split(",")))
target = int(input("Enter target sum: "))

result = two_sum(numbers, target)

if result:
    print("Indices:", result)
else:
    print("No matching pair found.")