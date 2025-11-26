<!DOCTYPE html>
<html>
<head>
    <title>Google Drive Procedures</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f0f5 0%, #f5e8ed 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(179, 89, 89, 0.15);
            border: 1px solid rgba(179, 89, 89, 0.2);
        }
        
        h2 {
            text-align: center;
            color: #8b4513;
            margin-bottom: 15px;
            font-size: clamp(1.8em, 4vw, 2.2em);
            background: linear-gradient(45deg, #a05252, #cd5c5c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.3;
        }
        
        .mind-map {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            margin-bottom: 25px;
        }
        
        .node {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            padding: clamp(15px, 3vw, 20px) clamp(18px, 4vw, 25px);
            border-radius: 15px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(205, 92, 92, 0.2);
            transition: all 0.3s ease;
            text-align: center;
            border: 2px solid #dc9a9a;
            position: relative;
            overflow: hidden;
            color: #8b4513;
            flex: 1;
            min-width: 120px;
            max-width: 200px;
        }
        
        .node:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
            transition: left 0.5s;
        }
        
        .node:hover:before {
            left: 100%;
        }
        
        .node:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(205, 92, 92, 0.3);
            background: linear-gradient(135deg, #f5c6cb 0%, #f8d7da 100%);
        }
        
        .main-topic {
            background: linear-gradient(135deg, #e8c4c8 0%, #d8a3a9 100%);
            color: #8b4513;
            font-weight: bold;
            font-size: clamp(0.9em, 2.5vw, 1.1em);
            border: 2px solid #c98989;
        }
        
        .main-topic:hover {
            background: linear-gradient(135deg, #d8a3a9 0%, #e8c4c8 100%);
        }
        
        .main-topic.active {
            background: linear-gradient(135deg, #cd5c5c, #a05252);
            color: white;
            border-color: #8b4513;
        }
        
        #procedure {
            margin-top: 20px;
            padding: 20px;
            background: linear-gradient(135deg, #f8e8e8 0%, #f5dfdf 100%);
            border-radius: 15px;
            color: #8b4513;
            box-shadow: 0 5px 15px rgba(205, 92, 92, 0.15);
            border: 2px solid #dc9a9a;
            min-height: 300px;
        }
        
        #procedure h3 {
            margin-top: 0;
            text-align: center;
            font-size: clamp(1.4em, 3vw, 1.8em);
            color: #a05252;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #cd5c5c;
            line-height: 1.3;
        }
        
        .step-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            border-left: 4px solid #cd5c5c;
            transition: all 0.3s ease;
            gap: 15px;
        }

        @media (min-width: 768px) {
            .step-container {
                flex-direction: row;
                align-items: flex-start;
            }
        }
        
        .step-container:hover {
            transform: translateX(5px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 12px rgba(205, 92, 92, 0.15);
        }
        
        .step-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        @media (min-width: 768px) {
            .step-header {
                margin-bottom: 0;
            }
        }
        
        .step-number {
            background: #cd5c5c;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1em;
            flex-shrink: 0;
        }

        @media (min-width: 768px) {
            .step-number {
                width: 40px;
                height: 40px;
                font-size: 1.2em;
            }
        }
        
        .step-content {
            flex: 1;
        }
        
        .step-title {
            font-size: clamp(1.1em, 2.5vw, 1.3em);
            color: #a05252;
            margin-bottom: 8px;
            font-weight: bold;
            line-height: 1.3;
        }
        
        .step-description {
            color: #8b4513;
            line-height: 1.5;
            font-size: clamp(0.9em, 2vw, 1em);
        }
        
        .step-image {
            width: 100%;
            height: 120px;
            border-radius: 10px;
            border: 3px solid #c98989;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            flex-shrink: 0;
            background: linear-gradient(135deg, #e8c4c8, #d8a3a9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8b4513;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }

        @media (min-width: 768px) {
            .step-image {
                width: 180px;
                height: 120px;
            }
        }

        @media (min-width: 1024px) {
            .step-image {
                width: 200px;
                height: 140px;
            }
        }
        
        .icon {
            font-size: clamp(1em, 2.5vw, 1.2em);
            margin-right: 6px;
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { 
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(205, 92, 92, 0.2);
            }
            50% { 
                transform: scale(1.05);
                box-shadow: 0 6px 20px rgba(205, 92, 92, 0.3);
            }
            100% { 
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(205, 92, 92, 0.2);
            }
        }
        
        .wine-glass {
            font-size: clamp(2em, 6vw, 2.5em);
            text-align: center;
            margin-bottom: 8px;
            opacity: 0.8;
        }
        
        .subtitle {
            text-align: center;
            color: #a05252;
            margin-bottom: 20px;
            font-style: italic;
            opacity: 0.8;
            font-size: clamp(0.9em, 2.5vw, 1em);
            line-height: 1.4;
        }
        
        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #dc9a9a, transparent);
            margin: 20px 0;
            border: none;
        }
        
        .highlight {
            background: linear-gradient(120deg, transparent 0%, transparent 50%, #fff9c4 50%);
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: bold;
        }

        .image-placeholder {
            font-size: clamp(2em, 6vw, 3em);
            margin-bottom: 8px;
        }

        .image-caption {
            font-size: clamp(0.8em, 2vw, 0.9em);
            color: #8b4513;
            text-align: center;
            line-height: 1.3;
        }

        .benefits {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            padding: 20px;
            border-radius: 10px;
            margin-top: 25px;
            border: 2px solid #dc9a9a;
        }

        .benefits h4 {
            color: #a05252;
            margin-bottom: 15px;
            text-align: center;
            font-size: 1.2em;
        }

        .benefits ul {
            list-style: none;
            padding: 0;
        }

        .benefits li {
            padding: 8px 0;
            color: #8b4513;
            border-bottom: 1px solid rgba(205, 92, 92, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .benefits li:before {
            content: "✓";
            color: #cd5c5c;
            font-weight: bold;
        }

        .benefits li:last-child {
            border-bottom: none;
        }

        /* Mobile-specific adjustments */
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            
            .container {
                padding: 15px;
                border-radius: 15px;
            }
            
            #procedure {
                padding: 15px;
            }
            
            .step-container {
                padding: 12px;
                margin-bottom: 15px;
            }
            
            .mind-map {
                gap: 8px;
            }
            
            .node {
                min-width: 100px;
                padding: 12px 15px;
            }

            .benefits {
                padding: 15px;
            }
        }

        /* Tablet adjustments */
        @media (min-width: 481px) and (max-width: 767px) {
            .mind-map {
                gap: 10px;
            }
            
            .node {
                min-width: 140px;
            }
        }

        /* Large desktop adjustments */
        @media (min-width: 1200px) {
            .container {
                padding: 30px;
            }
            
            #procedure {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Google Drive Procedures</h2>
        <div class="subtitle">Interactive Mind Map with Key Benefits</div>
        
        <hr class="divider">
        
        <div class="mind-map">
            <div class="node main-topic pulse active" onclick="showProc('upload')">
                <span class="icon">📤</span>Upload Files
            </div>
            <div class="node main-topic pulse" onclick="showProc('share')">
                <span class="icon">🔗</span>Share Files
            </div>
            <div class="node main-topic pulse" onclick="showProc('organize')">
                <span class="icon">📁</span>Organize Files
            </div>
        </div>

        <div id="procedure">
            <h3>📤 File Upload Procedure</h3>
            
            <div class="step-container">
                <div class="step-content">
                    <div class="step-header">
                        <div class="step-number">1</div>
                        <div class="step-title">Click "New" Button</div>
                    </div>
                    <div class="step-description">
                        Locate and click the <span class="highlight">New button</span> in the top-left corner of Google Drive interface.
                    </div>
                </div>
                <div class="step-image">
                    <div>
                        <div class="image-placeholder">🆕</div>
                        <div class="image-caption">New Button Location</div>
                    </div>
                </div>
            </div>
            
            <div class="step-container">
                <div class="step-content">
                    <div class="step-header">
                        <div class="step-number">2</div>
                        <div class="step-title">Select "File Upload"</div>
                    </div>
                    <div class="step-description">
                        Choose <span class="highlight">"File upload"</span> from the dropdown menu to open file browser.
                    </div>
                </div>
                <div class="step-image">
                    <div>
                        <div class="image-placeholder">📄</div>
                        <div class="image-caption">Upload Menu</div>
                    </div>
                </div>
            </div>
            
            <div class="step-container">
                <div class="step-content">
                    <div class="step-header">
                        <div class="step-number">3</div>
                        <div class="step-title">Choose Files</div>
                    </div>
                    <div class="step-description">
                        Select one or multiple files from your computer's file system.
                    </div>
                </div>
                <div class="step-image">
                    <div>
                        <div class="image-placeholder">💻</div>
                        <div class="image-caption">File Selection</div>
                    </div>
                </div>
            </div>
            
            <div class="step-container">
                <div class="step-content">
                    <div class="step-header">
                        <div class="step-number">4</div>
                        <div class="step-title">Wait for Upload</div>
                    </div>
                    <div class="step-description">
                        Monitor the progress bar until upload completes. Time depends on file size and internet speed.
                    </div>
                </div>
                <div class="step-image">
                    <div>
                        <div class="image-placeholder">⏳</div>
                        <div class="image-caption">Progress Indicator</div>
                    </div>
                </div>
            </div>
            
            <div class="step-container">
                <div class="step-content">
                    <div class="step-header">
                        <div class="step-number">5</div>
                        <div class="step-title">Files Appear in Drive</div>
                    </div>
                    <div class="step-description">
                        Uploaded files will be visible in your Drive with confirmation.
                    </div>
                </div>
                <div class="step-image">
                    <div>
                        <div class="image-placeholder">✅</div>
                        <div class="image-caption">Upload Complete</div>
                    </div>
                </div>
            </div>
            
            <div class="benefits">
                <h4>🎯 Key Benefits</h4>
                <ul>
                    <li>Access files from any device with internet</li>
                    <li>Automatic backup and version history</li>
                    <li>Secure cloud storage with Google's security</li>
                    <li>Easy sharing and collaboration</li>
                    <li>15GB free storage with Google account</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function showProc(type) {
            // Update active topic
            document.querySelectorAll('.main-topic').forEach(topic => {
                topic.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
            
            const procedures = {
                upload: {
                    title: "📤 File Upload Procedure",
                    steps: [
                        {
                            number: "1",
                            title: "Click \"New\" Button",
                            description: "Locate and click the <span class='highlight'>New button</span> in the top-left corner of Google Drive interface.",
                            image: "🆕",
                            caption: "New Button Location"
                        },
                        {
                            number: "2",
                            title: "Select \"File Upload\"",
                            description: "Choose <span class='highlight'>\"File upload\"</span> from the dropdown menu to open file browser.",
                            image: "📄",
                            caption: "Upload Menu"
                        },
                        {
                            number: "3",
                            title: "Choose Files",
                            description: "Select one or multiple files from your computer's file system.",
                            image: "💻",
                            caption: "File Selection"
                        },
                        {
                            number: "4",
                            title: "Wait for Upload",
                            description: "Monitor the progress bar until upload completes. Time depends on file size and internet speed.",
                            image: "⏳",
                            caption: "Progress Indicator"
                        },
                        {
                            number: "5",
                            title: "Files Appear in Drive",
                            description: "Uploaded files will be visible in your Drive with confirmation.",
                            image: "✅",
                            caption: "Upload Complete"
                        }
                    ],
                    benefits: [
                        "Access files from any device with internet",
                        "Automatic backup and version history",
                        "Secure cloud storage with Google's security",
                        "Easy sharing and collaboration",
                        "15GB free storage with Google account"
                    ]
                },
                share: {
                    title: "🔗 File Sharing Procedure",
                    steps: [
                        {
                            number: "1",
                            title: "Right-Click the File",
                            description: "Right-click on the file you want to share to open the context menu.",
                            image: "🖱️",
                            caption: "Right-Click Menu"
                        },
                        {
                            number: "2",
                            title: "Click \"Share\"",
                            description: "Select <span class='highlight'>\"Share\"</span> from the context menu to open sharing dialog.",
                            image: "👥",
                            caption: "Share Option"
                        },
                        {
                            number: "3",
                            title: "Add People or Get Link",
                            description: "Enter email addresses or click <span class='highlight'>\"Copy link\"</span> for broader sharing.",
                            image: "📧",
                            caption: "Share Dialog"
                        },
                        {
                            number: "4",
                            title: "Set Permission Levels",
                            description: "Choose between <span class='highlight'>Viewer, Commenter, or Editor</span> roles.",
                            image: "🔐",
                            caption: "Permissions"
                        },
                        {
                            number: "5",
                            title: "Send or Copy Link",
                            description: "Click <span class='highlight'>\"Send\"</span> to email or use copied link to share manually.",
                            image: "🚀",
                            caption: "Complete Sharing"
                        }
                    ],
                    benefits: [
                        "Real-time collaboration with multiple people",
                        "Control exactly who can access your files",
                        "Different permission levels for different needs",
                        "Track changes and comments",
                        "Secure sharing with expiration options"
                    ]
                },
                organize: {
                    title: "📁 File Organization Procedure",
                    steps: [
                        {
                            number: "1",
                            title: "Create New Folder",
                            description: "Click <span class='highlight'>\"New\" → \"Folder\"</span> to create organized directory structures.",
                            image: "📂",
                            caption: "New Folder"
                        },
                        {
                            number: "2",
                            title: "Name Your Folder",
                            description: "Give folders <span class='highlight'>descriptive names</span> for easy identification.",
                            image: "✏️",
                            caption: "Folder Naming"
                        },
                        {
                            number: "3",
                            title: "Drag and Drop Files",
                            description: "Move files into appropriate folders using <span class='highlight'>drag and drop</span>.",
                            image: "👆",
                            caption: "Drag & Drop"
                        },
                        {
                            number: "4",
                            title: "Use Color Labels",
                            description: "Apply <span class='highlight'>color coding</span> to folders for visual organization.",
                            image: "🎨",
                            caption: "Color Labels"
                        },
                        {
                            number: "5",
                            title: "Star Important Files",
                            description: "Mark key files with stars for quick access in <span class='highlight'>\"Starred\"</span> section.",
                            image: "⭐",
                            caption: "Starred Files"
                        }
                    ],
                    benefits: [
                        "Quick file retrieval with organized structure",
                        "Better collaboration with clear folder hierarchy",
                        "Visual organization with color coding",
                        "Personal quick-access with starred files",
                        "Efficient workflow with consistent naming"
                    ]
                }
            };
            
            const content = procedures[type];
            const procedureDiv = document.getElementById('procedure');
            
            procedureDiv.innerHTML = `
                <h3>${content.title}</h3>
                
                ${content.steps.map(step => `
                    <div class="step-container">
                        <div class="step-content">
                            <div class="step-header">
                                <div class="step-number">${step.number}</div>
                                <div class="step-title">${step.title}</div>
                            </div>
                            <div class="step-description">${step.description}</div>
                        </div>
                        <div class="step-image">
                            <div>
                                <div class="image-placeholder">${step.image}</div>
                                <div class="image-caption">${step.caption}</div>
                            </div>
                        </div>
                    </div>
                `).join('')}
                
                <div class="benefits">
                    <h4>🎯 Key Benefits</h4>
                    <ul>
                        ${content.benefits.map(benefit => `<li>${benefit}</li>`).join('')}
                    </ul>
                </div>
            `;
            
            // Remove pulse animation after click
            const nodes = document.querySelectorAll('.node');
            nodes.forEach(node => node.classList.remove('pulse'));
        }
    </script>
</body>
</html>