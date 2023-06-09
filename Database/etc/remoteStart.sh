#!/bin/bash

# Check if MySQL server is already running
if sudo systemctl is-active mysql > /dev/null 2>&1; then
    echo "MySQL is already started, here is the status"
    echo "MySQL status:"
    sudo systemctl status mysql | grep -E "Loaded|Active|Process|Main|Status"
else
    # Start MySQL server
    sudo systemctl start mysql
    echo "MySQL was off, and is now started"
    echo "MySQL status:"
    sudo systemctl status mysql | grep -E "Loaded|Active|Process|Main|Status"
fi

# Check if RegisterStep3 is already running
if pgrep -f "php regStep3.php" > /dev/null; then
    echo "###############################"
    echo "RegisterStep3 is already running"
    echo "###############################"
else
    # Start RegisterStep3 in a new terminal window
    echo "#################################"
    echo "Starting RegisterStep3"
    echo "#################################"
    gnome-terminal -- /bin/bash -c "php regStep3.php; exec bash"
    echo "#################################"
fi

# Check if LoginStep3 is already running
if pgrep -f "php logStep3.php" > /dev/null; then
    echo "###############################"
    echo "LoginStep3 is already running"
    echo "###############################"
else
    # Start LoginStep3 in a new terminal window
    echo "#################################"
    echo "Starting LoginStep3"
    echo "#################################"
    gnome-terminal -- /bin/bash -c "php logStep3.php; exec bash"
    echo "#################################"
fi

