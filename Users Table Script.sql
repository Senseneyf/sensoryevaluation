USE [Sensory Evaluation]
GO

/****** Object:  Table [dbo].[Users]    Script Date: 1/27/2018 5:54:48 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Users](
	[User_Id] [int] IDENTITY(1,1) NOT NULL,
	[First Name] [nchar](50) NOT NULL,
	[Last Name] [nchar](50) NOT NULL,
	[email] [nchar](50) NOT NULL,
	[password] [nchar](50) NOT NULL,
	[User_Type] [nchar](50) NOT NULL,
 CONSTRAINT [PK_Users] PRIMARY KEY CLUSTERED 
(
	[User_Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO


