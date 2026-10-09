<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Basiz Assessment</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f6f8;
            color: #222;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 270px;
            min-height: 100vh;
            background-color: #1f2937;
            color: #ffffff;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 25px 22px;
            border-bottom: 1px solid #374151;
        }

        .sidebar-brand h2 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .sidebar-brand span {
            display: block;
            margin-top: 4px;
            color: #9ca3af;
            font-size: 14px;
        }

        .sidebar-navigation {
            padding: 20px 12px;
        }

        .navigation-section {
            margin-bottom: 25px;
        }

        .section-title {
            padding: 0 10px;
            margin-bottom: 8px;
            color: #9ca3af;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0.8px;
        }

        .navigation-link {
            display: flex;
            flex-direction: column;
            gap: 3px;
            padding: 11px 12px;
            margin-bottom: 4px;
            color: #d1d5db;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .navigation-link span:first-child {
            font-size: 11px;
            color: #9ca3af;
        }

        .navigation-link span:last-child {
            font-size: 14px;
        }

        .navigation-link:hover {
            background-color: #374151;
            color: #ffffff;
        }

        .main-content {
            margin-left: 270px;
            width: calc(100% - 270px);
            min-height: 100vh;
            padding: 35px;
        }

    </style>

</head>

<body>

<div class="app-container">

    <?php require_once __DIR__ . "/sidebar.php"; ?>

    <main class="main-content">